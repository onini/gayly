<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaylyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('gayly.database.users_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 190)->unique();
            $table->string('email', 60)->unique();
            $table->string('password', 100);
            $table->string('name')->nullable()->index();
            $table->string('avatar')->nullable()->index();
            $table->string('mobile', 20)->nullable();
            $table->string('wechat', 30)->nullable();
            $table->string('qq', 20)->nullable();
            $table->string('status', 10)->default('normal')->comment('normal: 正常, disable: 禁用');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create(config('gayly.database.roles_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50);
            $table->timestamps();
        });

        Schema::create(config('gayly.database.permissions_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50);
            $table->string('http_method')->nullable();
            $table->text('http_path');
            $table->timestamps();
        });

        Schema::create(config('gayly.database.menus_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->integer('order')->default(0);
            $table->string('title', 50);
            $table->string('icon', 50);
            $table->string('uri', 50)->nullable();
            $table->timestamps();
        });

        Schema::create(config('gayly.database.role_users_table'), function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('user_id');
            $table->index(['role_id', 'user_id']);
            $table->timestamps();
        });

        Schema::create(config('gayly.database.role_permissions_table'), function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('permission_id');
            $table->index(['role_id', 'permission_id']);
            $table->timestamps();
        });

        Schema::create(config('gayly.database.user_permissions_table'), function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('permission_id');
            $table->index(['user_id', 'permission_id']);
            $table->timestamps();
        });

        Schema::create(config('gayly.database.role_menu_table'), function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('menu_id');
            $table->index(['role_id', 'menu_id']);
            $table->timestamps();
        });
        Schema::create(config('gayly.database.operation_log_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('path');
            $table->string('method', 10);
            $table->string('ip', 15);
            $table->text('input');
            $table->index('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('gayly.database.users_table'));
        Schema::dropIfExists(config('gayly.database.roles_table'));
        Schema::dropIfExists(config('gayly.database.permissions_table'));
        Schema::dropIfExists(config('gayly.database.menus_table'));
        Schema::dropIfExists(config('gayly.database.user_permissions_table'));
        Schema::dropIfExists(config('gayly.database.role_users_table'));
        Schema::dropIfExists(config('gayly.database.role_permissions_table'));
        Schema::dropIfExists(config('gayly.database.role_menu_table'));
        Schema::dropIfExists(config('gayly.database.operation_log_table'));
    }
}
