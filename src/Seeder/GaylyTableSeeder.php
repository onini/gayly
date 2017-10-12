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

namespace Onini\Gayly\Seeder;

use Illuminate\Database\Seeder;
use Onini\Gayly\Models\SystemUser;
use Onini\Gayly\Models\Permission;
use Onini\Gayly\Models\Role;
use Onini\Gayly\Models\Menu;

class GaylyTableSeeder extends Seeder
{
	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user.
        SystemUser::truncate();
        SystemUser::create([
            'username'  => 'gayly',
            'password'  => bcrypt('gayly'),
            'email' =>  'tthd@163.com',
            'name'      => '太年轻',
        ]);

        // create a role.
        Role::truncate();
        Role::create([
            'name'  => 'Administrator',
            'slug'  => 'administrator',
        ]);

        // add role to user.
        SystemUser::first()->roles()->save(Role::first());

        //create a permission
        Permission::truncate();
        Permission::insert([
            [
                'name'        => '所有权限',
                'slug'        => '*',
                'http_method' => '',
                'http_path'   => '*',
            ],
            [
                'name'        => '首页',
                'slug'        => 'dashboard',
                'http_method' => 'GET',
                'http_path'   => '/',
            ],
            [
                'name'        => '登录',
                'slug'        => 'login',
                'http_method' => '',
                'http_path'   => "/login\r\n/logout",
            ],
            [
                'name'        => '用户管理',
                'slug'        => 'auth.setting',
                'http_method' => 'GET,PUT',
                'http_path'   => '/auth/user',
            ],
            [
                'name'        => '权限管理',
                'slug'        => 'auth.management',
                'http_method' => '',
                'http_path'   => "/auth/roles\r\n/auth/permission\r\n/auth/menu\r\n/auth/log",
            ],
        ]);
        Role::first()->permissions()->save(Permission::first());

        // add default menus.
        Menu::truncate();
        Menu::insert([
            [
                'parent_id' => 0,
                'order'     => 1,
                'title'     => '首页',
                'icon'      => 'home',
                'uri'       => '/',
            ],
            [
                'parent_id' => 0,
                'order'     => 2,
                'title'     => '系统设置',
                'icon'      => 'dvr',
                'uri'       => '',
            ],
            [
                'parent_id' => 2,
                'order'     => 3,
                'title'     => '用户列表',
                'icon'      => '',
                'uri'       => 'auth/user',
            ],
            [
                'parent_id' => 2,
                'order'     => 4,
                'title'     => '角色分组',
                'icon'      => '',
                'uri'       => 'auth/role',
            ],
            [
                'parent_id' => 2,
                'order'     => 5,
                'title'     => '权限节点',
                'icon'      => '',
                'uri'       => 'auth/permission',
            ],
            [
                'parent_id' => 2,
                'order'     => 6,
                'title'     => '菜单',
                'icon'      => '',
                'uri'       => 'auth/menu',
            ],
            [
                'parent_id' => 2,
                'order'     => 7,
                'title'     => '日志管理',
                'icon'      => '',
                'uri'       => 'auth/log',
            ],
        ]);

        // add role to menu.
        Menu::find(2)->roles()->save(Role::first());
	}
}
