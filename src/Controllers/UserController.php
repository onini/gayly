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

namespace Onini\Gayly\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gayly;
use Onini\Gayly\Support\Layout\Row;
use Onini\Gayly\Support\Layout\Content;
use Onini\Gayly\Support\Grid;
use Onini\Gayly\Support\Form;
use Onini\Gayly\Support\Grid\Filter;
use Onini\Gayly\Models\SystemUser;
use Onini\Gayly\Models\Role;
use Onini\Gayly\Models\Permission;
use Onini\Gayly\Support\Grid\Column;
use Onini\Gayly\Support\Grid\Displayers\Actions;
use Onini\Gayly\Support\Grid\Tool;
use Onini\Gayly\Support\Grid\Tool\ActionButton;
use Onini\Gayly\Traits\ModelForm;

class UserController extends Controller
{

    use ModelForm;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Gayly::content(function (Content $content) {
            $content->title('用户列表');

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
            $content->title('创建用户');
            $content->row($this->form());
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
            $content->title(trans('gayly.edit'));
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * [profile description]
     * @method profile
     * @return [type]  [description]
     */
    public function profile()
    {
        return view('gayly::auth.user.profile');
    }

    public function profileEdit()
    {
        return view('gayly::auth.user.profile', ['form' => $this->form(true)->edit(Gayly::user()->id)]);
    }

    protected function grid()
    {
        return Gayly::grid(SystemUser::class, function (Grid $grid) {
            $grid->id('ID');
            $grid->username(trans('gayly.username'));
            $grid->name('昵称')->sortable()->setAttributes(['width' => 150]);
            $grid->roles(trans('gayly.roles'))->pluck('name')->label();
            $grid->email('邮箱');
            $grid->mobile('手机');
            $grid->wechat('微信');
            $grid->qq('QQ');
            // $grid->disableFilter();
            $grid->filter(function (Filter $filter) {
                $filter->removeIdFilter();
                $filter->like('name', '用户名');
            });

            $grid->actions(function (Actions $actions) {
                if ($actions->getKey() === 1) {
                    $actions->removeDelete();
                }
            });

            // $grid->paginate(1);

            // $grid->tool(function (Tool $tool) {
            //     $tool->batch(function (ActionButton $actions) {
            //         $actions->removeDelete();
            //         // $actions->add('测试', new \Onini\Gayly\Support\Grid\Tool\DeleteAction());
            //     });
            // });

            $grid->removeRowSelector();
        });
    }

    public function form($profile = false)
    {
        return SystemUser::form(function (Form $form) use ($profile) {
            $form->setWidth('col-md-8 col-md-offset-2');
            $profile && $form->disableHeader();
            $profile && $form->disableHeaderTool();
            !$profile && $form->text('username', trans('gayly.username'))->rules('required');
            $form->text('name', trans('gayly.name'))->rules('required');
            !$profile && $form->email('email', trans('gayly.email'))->rules('required');
            $form->image('avatar', trans('gayly.avatar'));
            $form->password('password', trans('gayly.password'))->rules('required|confirmed');
            $form->password('password_confirmation', trans('gayly.password_confirmation'))->rules('required')
                ->default(function ($form) {
                    return $form->model()->password;
                });

            $form->ignore(['password_confirmation']);

            !$profile && $form->multipleSelect('roles', trans('gayly.roles'))->options(Role::all()->pluck('name', 'id'));
            !$profile && $form->multipleSelect('permissions', trans('gayly.permissions'))->options(Permission::all()->pluck('name', 'id'));

            !$profile && $form->display('created_at', trans('gayly.created_at'));
            !$profile && $form->display('updated_at', trans('gayly.updated_at'));

            $form->saving(function (Form $form) {
                if ($form->password && $form->model()->password != $form->password) {
                    $form->password = bcrypt($form->password);
                }
            });

        });
    }
}
