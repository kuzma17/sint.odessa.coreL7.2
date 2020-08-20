<?php

namespace App\Admin\Controllers;

use App\StatusRepair;

use App\StatusRepairs;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Request;

class StatusRepairController extends Controller
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

            $content->header('Статусы');
            $content->description('ремонтов');

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

            $content->header('Статусы');
            $content->description('ремонтов');

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

            $content->header('Статусы');
            $content->description('ремонтов');

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
        return Admin::grid(StatusRepairs::class, function (Grid $grid) {

            $grid->column('id_1c', 'ID')->sortable();
            $grid->column('name', "status");
            $grid->column('name_site', "status site");
            $grid->column('color', "color")->display(function($color){
                return '<span class="badge" style="background-color: '.$color.'">'.$color.'</span>';
            });

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(StatusRepairs::class, function (Form $form) {

            $form->number('id_1c', 'ID')->rules('required');
            $form->text('name', 'status')->rules('required');
            $form->text('name_site', 'status site')->rules('required');
            $form->color('color', 'color');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

}
