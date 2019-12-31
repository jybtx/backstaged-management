<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('pid')->default(0)->comment('菜单关系');
            $table->string('name')->comment('菜单名称');
            $table->string('icon')->default('')->comment('图标');
            $table->string('controller')->default('')->comment('控制器名称');
            $table->string('url')->comment('菜单链接地址');
            $table->string('active')->comment('菜单高亮地址');
            $table->string('description')->default('')->comment('描述');
            $table->integer('sort')->default(0)->comment('排序');
            $table->text('active_model');
            $table->timestamps();
            $table->comment = '后台菜单表';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
