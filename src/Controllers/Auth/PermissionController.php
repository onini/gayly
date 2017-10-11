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
use Onini\Gayly\Models\Permission;
use Onini\Gayly\Support\Grid\Displayers\Actions;
use Onini\Gayly\Support\Grid\Tool;
use Onini\Gayly\Support\Grid\Tool\ActionButton;
use Illuminate\Support\Str;
use Onini\Gayly\Traits\ModelForm;
use Onini\Gayly\Support\Form;
use Onini\Gayly\Support\Layout\Content;

class PermissionController extends Controller
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
            $content->title('权限列表');
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
            $content->title(trans('gayly.permissions'));
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
            $content->title(trans('gayly.permissions'));
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function grid()
    {
        return Gayly::grid(Permission::class, function ($grid) {
            $grid->id('ID')->sortable()->setAttributes(['width' => 60]);
            $grid->slug(trans('gayly.slug'));
            $grid->name(trans('gayly.name'));

            $grid->http_path(trans('gayly.route'))->display(function ($path) {
                return collect(explode("\r\n", $path))->map(function ($path) {
                    $method = $this->http_method ?: ['ANY'];

                    if (Str::contains($path, ':')) {
                        list($method, $path) = explode(':', $path);
                        $method = explode(',', $method);
                    }

                    $method = collect($method)->map(function ($name) {
                        return strtoupper($name);
                    })->map(function ($name) {
                        return "<span class='label label-primary'>{$name}</span>";
                    })->implode('&nbsp;');

                    $path = '/'.trim(config('gayly.route.prefix'), '/').'/'.ltrim($path, '/');

                    return "<div class=\"m-b-5\">$method<code>$path</code></div>";
                })->implode('');
            });

            $grid->created_at(trans('gayly.created_at'));
            $grid->updated_at(trans('gayly.updated_at'));

            $grid->tool(function (Tool $tool) {
                $tool->batch(function (ActionButton $actions) {
                    $actions->removeDelete();
                });
            });

            $grid->filter(function ($filter) {
                $filter->equal('slug', '标识');
            });
        });
    }

    /**
     * [form description]
     * @method form
     * @return [type] [description]
     */
    public function form()
    {
        return Gayly::form(Permission::class, function (Form $form) {
            $form->display('id', 'ID');

            $form->text('slug', trans('gayly.slug'))->rules('required');
            $form->text('name', trans('gayly.name'))->rules('required');

            $form->multipleSelect('http_method', trans('gayly.http.method'))
            ->options($this->getHttpMethodsOptions())
            ->help('不选择默认为所有权限');
            $form->textarea('http_path', trans('gayly.http.path'));

            $form->display('created_at', trans('gayly.created_at'));
            $form->display('updated_at', trans('gayly.updated_at'));
        });
    }

    /**
     * Get options of HTTP methods select field.
     *
     * @return array
     */
    protected function getHttpMethodsOptions()
    {
        return array_combine(Permission::$httpMethods, Permission::$httpMethods);
    }
}
