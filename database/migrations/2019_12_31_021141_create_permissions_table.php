<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigInteger('role_id')->unsigned()->index()->comment('角色id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->bigInteger('menu_id')->unsigned()->index()->comment('栏目id');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->text('authority');
            $table->comment = '用戶權限表';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
