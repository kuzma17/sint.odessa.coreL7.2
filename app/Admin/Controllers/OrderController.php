<?php

namespace App\Admin\Controllers;

use App\ActRepair;
use App\History;
use App\Order;

use App\Status;
use App\StatusRepairs;
use App\TypeClient;
use App\TypeOrder;
use App\UserConsent;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\MessageBag;
use Request;

class OrderController extends Controller
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

            $content->header('Заказы');
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

            $content->header('Заказы');
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

            $content->header('Заказы');
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
        return Admin::grid(Order::class, function (Grid $grid) {

            $grid->model()->orderBy('id', 'desc');
            //$grid->model()->where('type_order_id', 1)->orderBy('id', 'desc');
            $grid->column('id', 'ID')->sortable();
            $grid->column('type_order.name', 'Тип услуги');
            $grid->column('type_client.name', 'Тип клиента');
            $grid->column('client_name', 'Клиент');
            $grid->column('status_id', 'Статус заказа')->display(function($id){
                return '<span class="badge" style="background-color: '.Status::find($id)->color.'">'.Status::find($id)->name.'</span>';
            });
            $grid->column('act_repair.status_repair_id', 'Статус ремонта')->display(function($id = 0){
                if($id != 0){
                    return '<span class="badge" style="background-color: '.StatusRepairs::find($id)->color.'" >'.StatusRepairs::find($id)->name.'</span>';
                }
                return '';
            });

            $grid->created_at();
            $grid->updated_at();
            $grid->disableCreation();
            $grid->actions(function($actions){
                $actions->disableDelete();
                $actions->disableEdit();
            });

            $grid->column('type_order_id', ' ')->display(function ($type) {
                if($type == 1){
                    $url = '/admin/orders/'.$this->id.'/edit';
                }else{
                    $url = '/admin/orderrepairs/'.$this->id.'/edit';
                }

                return '<a href="'.$url.'"><i class="fa fa-edit"></i></a>';

            });


            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->like('client_name', 'Клиент');
                $filter->is('type_order_id', 'Тип услуги')->select(TypeOrder::all()->pluck('name', 'id'));
                $filter->is('type_client_id', 'Тип клиента')->select(TypeClient::all()->pluck('name', 'id'));
                $filter->is('status_id', 'Статус заказа')->select(Status::all()->pluck('name', 'id'));
                $filter->is('act_repair.status_repair_id', 'Статус ремонта')->select(StatusRepairs::all()->pluck('name', 'id'));
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
        return Admin::form(Order::class, function (Form $form) {

            $form->tab('Клиент/Компания', function(Form $form) {;

                $form->text('id', 'ID');
                $form->select('status_id', 'Статус заказа')->options(Status::all()->pluck('name', 'id'));
                $form->display('user.name', 'ник заказчика');
                $form->display('type_order.name', 'тип заказа');
                $form->display('type_client.name', 'тип клиента');
                $form->display('client_name', 'ФИО заказчика/Название компании');
                $form->display('phone', 'телефон');
                $form->display('comment', 'комментарий');

                $form->display('created_at', 'Created At');
                $form->display('updated_at', 'Updated At');
            })->tab('Адрес доставки', function(Form $form){
                $form->display('delivery_town', 'город, населенный пункт');
                $form->display('delivery_street', 'улицаt');
                $form->display('delivery_house', 'дом');
                $form->display('delivery_house_block', 'корпус');
                $form->display('delivery_office', 'квартира');
            })->tab('Реквизиты компании', function(Form $form){
                $form->display('type_payment.name', 'Тип расчета');
                $form->display('company_full', 'Полное наименование компании');
                $form->display('edrpou', 'код ЕДРПОУ');
                $form->display('inn', 'код ИНН');
                $form->display('code_index', 'почтовый индекс');
                $form->display('region', 'область');
                $form->display('area', 'район');
                $form->display('city', 'город');
                $form->display('street', 'улица');
                $form->display('house', 'дом');
                $form->display('house_block', 'корпус');
                $form->display('office', 'номер офиса, квартиры');
            })->tab('История', function(Form $form){
                $form->html(function($form){
                    $histories = History::where('order_id', $form->model()->id)->get();
                    return view('admin.history', ['histories' => $histories]);
                });

            });
        });
    }
}
