<?php
// +----------------------------------------------------------------------
// | Gayly [ GOOD GOOD STUDY DAY DAY UP ]
// +----------------------------------------------------------------------
// | Copyright (c) http://smhx.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: gayly <tthd@163.com>
// +----------------------------------------------------------------------

namespace Onini\Gayly\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gayly;
use Onini\Gayly\Models\Role;
use Onini\Gayly\Models\Permission;
use Onini\Gayly\Support\Grid\Displayers\Actions;
use Onini\Gayly\Support\Grid\Tool;
use Onini\Gayly\Support\Grid\Tool\ActionButton;
use Onini\Gayly\Support\Layout\Content;
use Onini\Gayly\Traits\ModelForm;
use Onini\Gayly\Support\Form;

class RoleController extends Controller
{

    use ModelForm;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Gayly::content(function ($content) {
            $content->title('角色列表');
            $content->row($this->grid());
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Gayly::content(function (Content $content) {
            $content->title(trans('gayly.roles'));
            $content->body($this->form());
        });
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Gayly::content(function (Content $content) use ($id) {
            $content->title(trans('gayly.roles'));
            $content->body($this->form()->edit($id));
        });
    }

    protected function grid()
    {
        return Gayly::grid(Role::class, function ($grid) {
            $grid->id('ID')->sortable()->setAttributes(['width' => 80]);
            $grid->slug(trans('gayly.slug'));
            $grid->name(trans('gayly.name'));

            $grid->permissions(trans('gayly.permission'))->pluck('name')->label();

            $grid->created_at(trans('gayly.created_at'));
            $grid->updated_at(trans('gayly.updated_at'));

            $grid->actions(function (Actions $actions) {
                if ($actions->row->slug == 'administrator') {
                    $actions->removeDelete();
                }
            });

            $grid->tool(function (Tool $tool) {
                $tool->batch(function (ActionButton $actions) {
                    $actions->removeDelete();
                });
            });

            $grid->removeRowSelector();
        });
    }

    public function form()
    {
        return Gayly::form(Role::class, function (Form $form) {
            $form->setWidth('col-md-8 col-md-offset-2');
            // $form->display('id', 'ID');

            $form->text('slug', trans('gayly.slug'))->rules('required');
            $form->text('name', trans('gayly.name'))->rules('required');
            $form->listbox('permissions', trans('gayly.permissions'))->options(Permission::all()->pluck('name', 'id'));

            $form->display('created_at', trans('gayly.created_at'));
            $form->display('updated_at', trans('gayly.updated_at'));
        });
    }
}
