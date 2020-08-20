<?php

namespace App\Admin\Controllers;

use App\History;
use App\Order;

use App\Status;
use App\StatusRepairs;
use App\UserConsent;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class OrderRepairController extends Controller
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
            $content->description('на ремонт');

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
            $content->description('на ремонт');

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
            $content->description('на ремонт');

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

            $grid->model()->where('type_order_id', 2)->orderBy('id', 'desc');
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
                $form->display('address', 'адрес доставки');
                $form->display('comment', 'комментарий');

                $form->display('created_at', 'Created At');
                $form->display('updated_at', 'Updated At');

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
            })->tab('Параметры ремонта', function (Form $form) {
                $form->select('act_repair.status_repair_id', 'Статус ремонта')->options(StatusRepairs::all()->pluck('name', 'id'));
                $form->text('act_repair.device', 'ремонтируемое устройство');
                $form->text('act_repair.set_device', 'комплектация');
                $form->textarea('act_repair.text_defect', 'описание деффекта');
                $form->textarea('act_repair.diagnostic', 'диагностика');
                $form->text('act_repair.cost', 'стоимость');
                $form->textarea('act_repair.comment', 'комментарий');
                $form->select('act_repair.user_consent_id', 'Ответ заказчика')->options(UserConsent::all()->pluck('name', 'id'))->readOnly();
            })->tab('История', function(Form $form){
                $form->html(function($form){
                    $histories = History::where('order_id', $form->model()->id)->get();
                    return view('admin.history', ['histories' => $histories]);
                });

            });
        });
    }
}
