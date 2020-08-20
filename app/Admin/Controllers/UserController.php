<?php

namespace App\Admin\Controllers;

use App\TypeClient;
use App\TypePayment;
use App\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class UserController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Клиенты');
            $content->description('');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Клиенты');
            $content->description('');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('Клиенты');
            $content->description('');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(User::class, function (Grid $grid) {

            $grid->model()->orderBy('id', 'desc');
            $grid->column('id', 'ID')->sortable();
            $grid->column('name', 'Ник');
            $grid->column('profile.client_name', 'Имя');
            $grid->column('email','Email');
            $grid->column('avatar.avatar', 'аватар')->display(function ($img){
                if($img) {
                    return '<img src="/upload/' . $img . '" style="width:60px; height:60px">';
                }
                return '<img src="/images/no_img.png" style="width:60px; height:60px">';
            });
            $grid->column('profile.type_client_id', 'тип клиента')->display(function($id = 0){
                if($id != 0){
                //return TypeClient::find($id)->name;
                    $class = ["1"=>"label label-danger", "2"=>"label label-warning"];
                    return '<span class="'.$class[$id].'">'.TypeClient::find($id)->name.'</span>';
                }
                return "";
            });
            $grid->column('profile.phone', 'телефон');

            $grid->created_at();
            $grid->updated_at();

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->like('name', 'Ник');
                $filter->like('profile.client_name', 'Имя Клиента');
                $filter->like('email', 'email');
                $filter->like('profile.phone', 'телефон');
                $filter->is('profile.type_client_id', 'Тип клиента')->select(TypeClient::all()->pluck('name', 'id'));
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(User::class, function (Form $form) {

            $form->tab('Клиент/Компания', function(Form $form){

                $form->display('id', 'ID');
                $form->text('name', 'Ник');
                $form->text('profile.client_name', 'Имя');
                $form->email('email','Email');
                $form->image('avatar.avatar')->resize(160, 180)->uniqueName()->move('avatars');
                $form->password('password', 'Пароль');
                $form->select('profile.type_client_id', 'тип клиента')->options(TypeClient::all()->pluck('name', 'id'));
                $form->mobile('profile.phone', 'Телефон');
                //$form->text('address', 'Адрес доставки');
                $form->display('created_at', 'Created At');
                $form->display('updated_at', 'Updated At');
            })->tab('Адрес доставки', function(Form $form){
                $form->text('profile.delivery_town', 'город, населенный пункт');
                $form->text('profile.delivery_street', 'улица');
                $form->text('profile.delivery_house', 'дом');
                $form->text('profile.delivery_house_block', 'корпус');
                $form->text('profile.delivery_office', 'квартира');
            })->tab('Реквизиты компании', function(Form $form){
                $form->text('profile.user_company', 'представитель компании');
                $form->text('profile.company_full', 'Полное наименование организации');
                $form->select('profile.type_payment_id', 'тип оплаты')->options(TypePayment::all()->pluck('name', 'id'));
                $form->text('profile.edrpou', 'код ЕДРПОУ');
                $form->text('profile.inn', 'код ИНН');
            })->tab('Юридический адрес', function(Form $form){
                $form->text('profile.code_index', 'Почтовый индекс');
                $form->text('profile.region', 'Регион');
                $form->text('profile.area', 'Район');
                $form->text('profile.city', 'Город');
                $form->text('profile.street', 'Улица');
                $form->text('profile.house', 'Номер дома');
                $form->text('profile.house_block', 'Корпус');
                $form->text('profile.office', 'Офис/Квартира');
            });

            $form->saving(function (Form $form) { // Encryption and Save Password
                //if ($form->password && $form->model()->password != $form->password) {
                    $form->password = bcrypt($form->password);
                //}
            });
        });
    }
}
