<?php

namespace App\Admin\Controllers;

use App\Menu;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Tree;
use Request;

class MenuController extends Controller
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

            $content->header('Меню');
            $content->description('');

            //$content->body($this->grid());
            $content->body($this->tree());
        });

    }



    protected function tree()
    {
        return Menu::tree(function (Tree $tree) {
            $tree->branch(function ($branch) {
                if ($branch['active'] == 1){
                    $swith = '<div class="bootstrap-switch bootstrap-switch-small" style="position: absolute;right: 100px">
		                        <span class="bootstrap-switch-handle-on bootstrap-switch-success" style="width: 40px;">ON</span>
                                </div>';
                }else{
                    $swith = '<div class="bootstrap-switch bootstrap-switch-small" style="position: absolute;right: 100px">
		                        <span class="bootstrap-switch-handle-off bootstrap-switch-danger" style="width: 40px;">OFF</span>
                                </div>';
                }
                return "{$branch['id']} - {$branch['title']} <span style='position:absolute;right:50%'> {$branch['url']} </span> {$swith}";
            });
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

            $content->header('Меню');
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

            $content->header('Меню');
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
        return Admin::grid(Menu::class, function (Grid $grid) {

            $grid->column('id', 'ID')->sortable();
            $grid->column('title', 'title');
            $grid->column('url', 'url');
            $grid->column('weight', 'номер');
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
        return Admin::form(Menu::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', 'Название')->rules('required');
            $form->text('url', 'url')->rules('required')->placeholder('Уникальное значение');
            $form->select('parent_id', 'Родитель')->options($this->getSelectMenuItems());
            $form->number('weight', 'Номер')->default(Menu::all()->max('weight'));
            $form->switch('active')->states($this->states)->default(1);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

    protected function getSelectMenuItems(){
        return Menu::active()
            ->order()
            ->get()
            ->prepend(['title'=>'корень', 'id'=>0])
            ->pluck('title', 'id');
    }

    public function release(Request $request)
    {
        foreach (Menu::find($request->get('ids')) as $post) {
            $post->status = $request->get('action');
            $post->save();
        }
    }
}
