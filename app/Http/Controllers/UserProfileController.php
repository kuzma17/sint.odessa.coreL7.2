<?php

namespace App\Http\Controllers;

use App\Settings;
use App\User;
use App\UserAvatar;
use App\UserProfile;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Image;

class UserProfileController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function profile(){
        $user = Auth::user();
        return view('user.profile', ['user'=>$user]);
    }

    public function edit(Request $request){
        $user = Auth::user();
        //$profile = $user->profile;
        if($request->isMethod('post')) {

            $list_validate = [
                'client_name' => 'required|max:200',
                'email' => 'required|email',
                'phone' => 'required|max:10'
            ];

            if($request->input('type_client') == 2){
                $list_validate += [
                    //'company' => 'required',
                ];

                if($request->input('type_payment') == 2 || $request->input('type_payment') == 3){
                    $list_validate += [
                        'company_full' => 'required',
                        'edrpou' => 'required|min:8|max:10',
                        'code_index' => 'required|size:5',
                        'city' => 'required',
                        'street' => 'required',
                        'house' => 'required',
                    ];
                }

                if( $request->input('type_payment') == 3){
                    $list_validate += [
                        'inn' => 'required|size:10',
                    ];
                }
            }

            $this->validate($request, $list_validate );

            if($user->profile){
                $profile = $user->profile;;
            }else{
                $profile = new UserProfile();
            }

            //$profile->user_id = $user->id;
            $profile->user()->associate($user);
            $profile->client_name = $request->input('client_name');
            //$user->email = $request->input('email');
            $profile->type_client_id = $request->input('type_client');
            $profile->phone = $request->input('phone');
            $profile->delivery_town = $request->input('delivery_town');
            $profile->delivery_street = $request->input('delivery_street');
            $profile->delivery_house = $request->input('delivery_house');
            $profile->delivery_house_block = $request->input('delivery_house_block');
            $profile->delivery_office = $request->input('delivery_office');

            if($profile->type_client_id == 2) {
                $profile->user_company = $request->input('user_company');
                $profile->type_payment_id = $request->input('type_payment');

                if($profile->type_payment_id == 2 || $profile->type_payment_id == 3) {
                    $profile->company_full = $request->input('company_full');
                    $profile->edrpou = $request->input('edrpou');
                    $profile->code_index = $request->input('code_index');
                    $profile->region = $request->input('region');
                    $profile->area = $request->input('area');
                    $profile->city = $request->input('city');
                    $profile->street = $request->input('street');
                    $profile->house = $request->input('house');
                    $profile->house_block = $request->input('house_block');
                    $profile->office = $request->input('office');
                }

                if($profile->type_payment_id == 3) {
                    $profile->inn = $request->input('inn');
                }
            }

            //$user->save();
            $profile->save();
            Session::flash('ok_message', 'Данные Вашего профиля успешно сохранены.');
                //return $this->profile();
                return redirect('/user?act=save');
        }else {
                return view('user.edit_profile', ['user' => $user]);
        }
    }


    public function avatar(Request $request){
        $user = Auth::user();
        if($request->isMethod('post')) {

            $this->validate($request, [
                'avatar'  =>  'required|image|max:100',
            ]);

                $image = $request->file('avatar');
                Image::make($image->getRealPath())->resize(160, 160)->save();
                $saveImageName = str_random(10) . '.' . $image->getClientOriginalExtension();

            if(UserAvatar::where('user_id', $user->id)->first()) {
                $avatar = UserAvatar::where('user_id', $user->id)->first();
            }else{
               $avatar = new UserAvatar();
            }

            $image->move('upload/avatars', $saveImageName);

            $avatar->user()->associate($user);
            $avatar->avatar = 'avatars/'.$saveImageName;
            $avatar->save();
            Session::flash('ok_message', 'Ваш аватар успешно соxранен.');
            return $this->profile();
        }else{
            return view('user.edit_avatar');
        }
    }

    public function avatar_(Request $request){
        $user = Auth::user();
        if($request->isMethod('post')) {

            $this->validate($request, [
                'avatar'  =>  'required|image|max:100',
            ]);
            $image = $request->file('avatar');
            Image::make($image->getRealPath())->resize(160, 160)->save();
            $saveImageName = str_random(10) . '.' . $image->getClientOriginalExtension();

            if($user->profile) {
                $profile = $user->profile;;
            }else{
                $profile = new UserProfile();
            }
            $profile->avatar = $image->move('images/avatars', $saveImageName);
            $profile->save();
            Session::flash('ok_message', 'Ваше фото успешно соxранено.');
            return $this->profile();
        }else{
            return view('user.edit_avatar');
        }
    }

    public function dell_avatar(){
        $user = Auth::user();
        UserAvatar::destroy($user->id);
        Session::flash('ok_message', 'Ваше фото успешно удалено.');
            return $this->profile();
    }

    public function edit_password(Request $request){
        if($request->isMethod('post')){
            $this->validate($request, [
                'old_password' => 'required|oldpassword',
                'password'  =>  'required|min:6|confirmed',
            ]);
            //if(Hash::check($request->old_password, Auth::user()->password)){
                $tek_user = User::find(Auth::id());
                $tek_user->password = Hash::make($request->password);
                $tek_user->save();
                Session::flash('ok_message', 'Ваш пароль успешно изменен.');
            return $this->profile();
           //}
        }else{
            return view('user.edit_password');
        }
    }

    public static function count_users(){
        $this_date = date("Y-m-d", strtotime("-1 days"));
        $users = User::where('created_at', '>=', $this_date)->count();
        return $users;
    }

}
