<?php

namespace App\Admin\Controllers;

use App\Page;
use App\Slider;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Request;

class SliderController extends Controller
{
    use ModelForm;

    protected $states = [
        'on' => ['text' => 'ON', 'color' => 'success'],
        'off' => ['text' => 'OFF', 'color' => 'danger'],
    ];

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Слайдер');
            $content->description('на главной');

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

            $content->header('Слайдер');
            $content->description('на главной');

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

            $content->header('Слайдер');
            $content->description('на главной');

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
        return Admin::grid(Slider::class, function (Grid $grid) {

            $grid->column('id', 'ID')->sortable();
            //$grid->column('weight', 'Номер')->sortable();
            $grid->column('weight', 'Номер')->editable()->sortable();
            $grid->column('image', 'Картинка')->display(function ($img){
                return '<img src="/upload/'.$img.'" style="width:200px; height:60px">';
            });
            $grid->column('url', 'url');
            $grid->column('slogan', 'Слоган')->editable();
            $grid->column('active', 'Статус')->switch($this->states);

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
        return Admin::form(Slider::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->image('image')->resize(965, 400)->uniqueName()->move('slider')->rules('required');
            $form->text('url', 'url');
            $form->text('slogan', 'слоган');
            $form->number('weight', 'номер')->default(Slider::max('weight')+1);
            $form->switch('active')->states($this->states)->default(1);
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

    public function release(Request $request)
    {
        foreach (Slider::find($request->get('ids')) as $post) {
            $post->status = $request->get('action');
            $post->save();
        }
    }
}
