<?php

namespace App\Http\Controllers;

use App\ActRepair;
use App\History;
use App\Notifications\CreatedOrder;
use App\Order;
use App\TypeOrder;
use App\User;
use App\UserConsent;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function order_list(){
        $user = Auth::user();
        if($orders = Order::where('user_id', $user->id)->orderby('created_at', 'desc')->paginate(15)){
            return view('user.order_list', ['orders'=>$orders]);
        }else{
            Session::flash('ok_message', 'У Вас пока нет сохраненных заказов.');
            return redirect('/user');
        }
    }

    public function order($id){
        $user = Auth::user();
        $order = Order::find($id);
        return view('user.order', ['user'=>$user, 'order'=>$order]);
    }

    public function add_order(Request $request){
        $user = Auth::user();
        $type_order = TypeOrder::all();

        if($request->isMethod('post')){

            if($request->input('all_order')){
                return view('order.order', ['order'=>$request, 'user' => $user, 'type_order' => $type_order]);
            }

            $list_validate = [
                'order_client_name' => 'required',
                'order_email' => 'required',
                'order_phone' => 'required|max:10',
                'order_delivery_town' => 'required',
                'order_delivery_street' => 'required',
                'order_delivery_house' => 'required'
            ];

            if($request->input('add_all_order')){
                if($request->input('order_type_payment') == 2 || $request->input('order_type_payment') == 3) {
                    $list_validate += [
                        'order_company_full' => 'required',
                        'order_edrpou' => 'required|min:8|max:10',
                        'order_code_index' => 'required|size:5',
                        'order_city' => 'required',
                        'order_street' => 'required',
                        'order_house' => 'required',
                    ];
                }
                if( $request->input('order_type_payment') == 3){
                    $list_validate += [
                        'order_inn' => 'required|size:10',
                    ];
                }
            }

            $this->validate($request, $list_validate );

            $order = new Order();
            if($user->profile){
                $profile = $user->profile;
            }else{
                $profile = new UserProfile();
            }

            //$order->user_id = $user->id;
            $order->user()->associate($user);
            //$profile->user_id = $user->id;
            $profile->user()->associate($user);

            $delivery_house_bloc = $request->input('order_delivery_house_block') ? $request->input('order_delivery_house_block') : '';
            $delivery_office = $request->input('order_delivery_office') ? $request->input('order_delivery_office') : '';

            $order->type_order_id = $request->input('type_order');

           // $order->type_client_id = $request->input('order_type_client');
          //  $profile->type_client_id = $request->input('order_type_client');

           // $order->client_name = $request->input('order_client_name');
          //  $profile->client_name = $request->input('order_client_name');

            $user->email = $request->input('order_email');

           // $order->phone = $request->input('order_phone');
           // $profile->phone = $request->input('order_phone');

            $order->delivery_town = $request->input('order_delivery_town');
            $profile->delivery_town = $request->input('order_delivery_town');

            $order->delivery_street = $request->input('order_delivery_street');
            $profile->delivery_street = $request->input('order_delivery_street');

            $order->delivery_house = $request->input('order_delivery_house');
            $profile->delivery_house = $request->input('order_delivery_house');

            $order->delivery_house_block = $delivery_house_bloc;
            $profile->delivery_house_block = $delivery_house_bloc;

            $order->delivery_office = $delivery_office;
            $profile->delivery_office = $delivery_office;

            if($order->type_client_id == 2) {

                $order->user_company = $request->input('order_user_company');
                $profile->user_company = $request->input('order_user_company');

                $order->type_payment_id = $request->input('order_type_payment');
                $profile->type_payment_id = $request->input('order_type_payment');

                if($order->type_payment_id == 2 || $order->type_payment_id == 3){

                    $order->company_full = $request->input('order_company_full');
                    $profile->company_full = $request->input('order_company_full');

                    $order->edrpou = $request->input('order_edrpou');
                    $profile->edrpou = $request->input('order_edrpou');

                    $order->code_index = $request->input('order_code_index');
                    $profile->code_index = $request->input('order_code_index');

                    $order->region = $request->input('order_region');
                    $profile->region = $request->input('order_region');

                    $order->area = $request->input('order_area');
                    $profile->area = $request->input('order_area');

                    $order->city = $request->input('order_city');
                    $profile->city = $request->input('order_city');

                    $order->street = $request->input('order_street');
                    $profile->street = $request->input('order_street');

                    $order->house = $request->input('order_house');
                    $profile->house = $request->input('order_house');

                    $order->house_block = $request->input('order_house_block');
                    $profile->house_block = $request->input('order_house_block');

                    $order->office = $request->input('order_office');
                    $profile->office = $request->input('order_office');
                }
                if($order->type_payment_id == 3){
                    $order->inn = $request->input('order_inn');
                    $profile->inn = $request->input('order_inn');
                }
            }
            $order->comment = $request->input('order_comment');

            $order->save();
            $profile->save();
            $user->save();

           // $order->notify(new CreatedOrder()); // Send message to mail

            Session::flash('ok_message', 'Ваш заказ успешно создан и будет обработан в ближайшее время.');
            return redirect('/user/order/'.$order->id);
        }else {
            return view('order.order', ['user' => $user, 'type_order' => $type_order]);
        }
    }

    public function user_consent(Request $request){
        $order_id = $request->input('order_id');
        $repair = ActRepair::where('order_id', $order_id)->first();
        $repair->user_consent_id = $request->input('user_consent');
        $repair->comment = $request->input('comment');
        $repair->save();

        // Save History
        $history = new History();
        $history->order_id = $order_id;
        $history->status_info = UserConsent::find($repair->user_consent_id)->name;
        $history->comment = $repair->comment;
        $history->save();
        // End Save History

        Session::flash('ok_message', 'Ваш заказ успешно подтвержден и будет обработан в ближайшее время.');
        return redirect('/user/order/'.$order_id);
    }

    public static function count_new_orders(){
        //$this_date = date("Y-m-d", strtotime("-1 days"));
        $orders = Order::where('status_id', 1)->count();
        return $orders;
    }

    public static function count_day_orders($day=30){
        for($i=$day; $i >= 0; $i--){
            $min = $i + 1;
            $max = $i - 1;
            $date_min = date("Y-m-d", strtotime("-$min days"));
            $date_max = date("Y-m-d", strtotime("-$max days"));

            $oreders = Order::whereRaw("created_at > '$date_min' and created_at < '$date_max'")->count();

            $array_order[] = $oreders;
            $array_date[] = date("d.m", strtotime("-$i days"));
        }

        $adapt_data = [
            'labelArray' => json_encode( $array_date, JSON_UNESCAPED_UNICODE),
            'dataArray' => json_encode( $array_order, JSON_UNESCAPED_UNICODE),
        ];
        return $adapt_data;
    }
}
