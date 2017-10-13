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
use Onini\Gayly\Support\Grid\Filter;
use Onini\Gayly\Models\OperationLog;
use Onini\Gayly\Models\SystemUser;
use Onini\Gayly\Support\Grid\Column;
use Onini\Gayly\Support\Grid\Displayers\Actions;
use Onini\Gayly\Support\Grid\Tool;
use Onini\Gayly\Support\Grid\Tool\ActionButton;

class OperationLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Gayly::content(function ($content) {
            $content->title('日志管理');

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ids = explode(',', $id);

        if (OperationLog::destroy(array_filter($ids))) {
            return response()->json([
                'status'  => true,
                'message' => trans('gayly.delete_succeeded'),
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => trans('gayly.delete_failed'),
            ]);
        }
    }

    protected function grid()
    {
        return Gayly::grid(OperationLog::class, function ($grid) {
            $grid->id()->setAttributes(['width' => 60])->sortable();
            $grid->path('路径')->label('success');
            $grid->user()->name('用户')->setAttributes(['width' => 110]);
            $grid->method('类型')->display(function ($method) {
                $color = array_get(OperationLog::$methodColors, $method, 'default');

                return "<span class=\"label label-$color\">$method</span>";
            });
            $grid->ip()->label('inverse');
            $grid->input()->display(function ($input) {
                $input = json_decode($input, true);
                $input = array_except($input, ['_pjax', '_token', '_method', '_previous_']);
                if (empty($input)) {
                    return '<code>{}</code>';
                }

                return '<code>'.json_encode($input, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE).'</code>';
            });
            $grid->created_at(trans('gayly.created_at'))->setAttributes(['width' => 160]);

            $grid->actions(function (\Onini\Gayly\Support\Grid\Displayers\Actions $actions) {
                $actions->removeEdit();
            });

            $grid->removeCreate();
            $grid->filter(function ($filter) {
               $filter->equal('user_id', 'User')->select(SystemUser::all()->pluck('name', 'id'));
               $method = collect(array_combine(OperationLog::$methods, OperationLog::$methods))->prepend('All', '');
               $filter->equal('method')->select($method);
               $filter->like('path', '路径');
               $filter->equal('ip', 'IP');
           });

        });
    }
}
