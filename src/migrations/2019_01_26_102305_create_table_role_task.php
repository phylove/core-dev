<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRoleTask extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phy_role_task', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('role_id');
            $table->bigInteger('task_id');
            $table->bigInteger('version');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->bigInteger('created_at');
            $table->bigInteger('updated_at');
            $table->index(['role_id', 'task_id']);
            $table->unique(['role_id', 'task_id']);
        });

        DB::statement(
            "INSERT INTO phy_role_task(role_id, task_id, version, created_by, updated_by, created_at, updated_at)
            SELECT -1, id, 0, -1, -1, ".date("YmdHis").", ".date("YmdHis")." FROM phy_tasks WHERE task_group='manageUser'"
        );
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
