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
use Onini\Gayly\Support\Grid\Displayers\Actions;
use Onini\Gayly\Support\Grid\Tool;
use Onini\Gayly\Support\Grid\Tool\ActionButton;

class RoleController extends Controller
{
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
        //
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
}
