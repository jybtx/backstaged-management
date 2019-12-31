<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->comment('用户名');
            $table->string('name')->nullable()->comment('管理员姓名');
            $table->string('email')->unique()->nullable()->comment('管理员邮箱');
            $table->tinyInteger('role_id')->comment('管理员所属角色');
            $table->tinyInteger('is_ban')->default(0)->comment('管理员被是否禁用;0、没有；1、禁用');
            $table->bigInteger('telphone')->nullable()->comment('管理员电话号码');
            $table->string('password')->comment('密码');
            $table->string('avatar')->nullable()->comment('管理员头像');
            $table->rememberToken();
            $table->timestamps();
            $table->comment = '后台管理员表';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
