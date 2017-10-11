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
use Onini\Gayly\Models\Menu;
use Onini\Gayly\Models\Role;
use Onini\Gayly\Support\Tree;
use Onini\Gayly\Support\Form;
use Onini\Gayly\Support\Widgets\Box;
use Onini\Gayly\Traits\ModelForm;

class MenuController extends Controller
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
            $content->title('系统菜单');
            $content->row(function ($row) {
                $row->column(6, $this->tree());
                $row->column(6, function ($column) {
                    $form = new \Onini\Gayly\Support\Widgets\Form();
                    $form->action(gayly_base_path('auth/menu'));

                    $form->select('parent_id', trans('gayly.parent_id'))->options(Menu::selectOptions());
                    $form->text('title', trans('gayly.title'))->rules('required');
                    $form->icon('icon', trans('gayly.icon'))->default('fa-bars')->rules('required')->help($this->iconHelp());
                    $form->text('uri', trans('gayly.uri'));
                    $form->multipleSelect('roles', trans('gayly.roles'))->options(Role::all()->pluck('name', 'id'));

                    $column->append((new Box(trans('gayly.new'), $form))->style('success'));
                });
            });
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Gayly::content(function ($content) use ($id) {
            $content->title(trans('gayly.menu'));
            $content->row($this->form()->edit($id));
        });
    }

    protected function tree()
    {
        return Menu::tree(function (Tree $tree) {
            $tree->disableCreate();

            $tree->branch(function ($branch) {
                $payload = "<i class='fa {$branch['icon']}'></i>&nbsp;<strong>{$branch['title']}</strong>";

                if (!isset($branch['children'])) {
                    if (url()->isValidUrl($branch['uri'])) {
                        $uri = $branch['uri'];
                    } else {
                        $uri = gayly_base_path($branch['uri']);
                    }

                    // $payload .= "&nbsp;&nbsp;&nbsp;<a href=\"$uri\" class=\"dd-nodrag\">$uri</a>";
                }

                return $payload;
            });
        });
    }

    /**
 * Make a form builder.
 *
 * @return Form
 */
    public function form()
    {
        return Menu::form(function (Form $form) {
            $form->row( function ($form) {
                $form->display('id', 'ID');

                $form->select('parent_id', trans('gayly.parent_id'))->options(Menu::selectOptions());
                $form->text('title', trans('gayly.title'))->rules('required');
                $form->icon('icon', trans('gayly.icon'))->default('fa-bars')->rules('required')->help($this->iconHelp());
                $form->text('uri', trans('gayly.uri'));
                $form->multipleSelect('roles', trans('gayly.roles'))->options(Role::all()->pluck('name', 'id'));

                $form->display('created_at', trans('gayly.created_at'));
                $form->display('updated_at', trans('gayly.updated_at'));
            });

        });
    }

    /**
     * Help message for icon field.
     *
     * @return string
     */
    protected function iconHelp()
    {
        return '查看更多icon <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a>';
    }
}
