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
use Onini\Gayly\Models\SystemUser;
use Onini\Gayly\Support\Grid\Column;
use Onini\Gayly\Support\Grid\Displayers\Actions;
use Onini\Gayly\Support\Grid\Tool;
use Onini\Gayly\Support\Grid\Tool\ActionButton;

class UserController extends Controller
{
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
        });
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        return Gayly::content(function (Content $content) {
            $content->title('修改用户');
        });
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        //
    }

    protected function grid()
    {
        return Gayly::grid(SystemUser::class, function (Grid $grid) {
            // $grid->id('ID');
			$grid->name('昵称')->sortable();
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

            $grid->tool(function (Tool $tool) {
                $tool->batch(function (ActionButton $actions) {
                    $actions->removeDelete();
                    $actions->add('测试', new \Onini\Gayly\Support\Grid\Tool\DeleteAction());
                });
            });

            // $grid->removeRowSelector();

        });
    }
}
