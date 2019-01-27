<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phy_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('task_name', 100)->unique();
            $table->string('task_group', 100)->index();
            $table->string('task_description', 255);
            $table->bigInteger('version');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->bigInteger('created_at');
            $table->bigInteger('updated_at');
        });

        // insert human task task
        DB::table('phy_tasks')->insert([
            'task_name' => 'viewUser',
            'task_description' => 'View User',
            'task_group' => 'manageUser',            
            'version' => 0,
            'created_by' => -1,
            'updated_by' => -1,
            'created_at' => date("YmdHis"),
            'updated_at' => date("YmdHis")
        ]);

        // insert human task task
        DB::table('phy_tasks')->insert([
            'task_name' => 'addUser',
            'task_description' => 'Add User',
            'task_group' => 'manageUser', 
            'version' => 0,
            'created_by' => -1,
            'updated_by' => -1,
            'created_at' => date("YmdHis"),
            'updated_at' => date("YmdHis")
        ]);

        // insert human task task
        DB::table('phy_tasks')->insert([
            'task_name' => 'editUser',
            'task_description' => 'Edit User',
            'task_group' => 'manageUser', 
            'version' => 0,
            'created_by' => -1,
            'updated_by' => -1,
            'created_at' => date("YmdHis"),
            'updated_at' => date("YmdHis")
        ]);

        // insert human task task
        DB::table('phy_tasks')->insert([
            'task_name' => 'removeUser',
            'task_description' => 'Remove User',
            'task_group' => 'manageUser', 
            'version' => 0,
            'created_by' => -1,
            'updated_by' => -1,
            'created_at' => date("YmdHis"),
            'updated_at' => date("YmdHis")
        ]);

        // insert human task task
        DB::table('phy_tasks')->insert([
            'task_name' => 'restoreUser',
            'task_description' => 'Restore User',
            'task_group' => 'manageUser', 
            'version' => 0,
            'created_by' => -1,
            'updated_by' => -1,
            'created_at' => date("YmdHis"),
            'updated_at' => date("YmdHis")
        ]);

        // insert human task task
        DB::table('phy_tasks')->insert([
            'task_name' => 'deleteUser',
            'task_description' => 'Delete User',
            'task_group' => 'manageUser', 
            'version' => 0,
            'created_by' => -1,
            'updated_by' => -1,
            'created_at' => date("YmdHis"),
            'updated_at' => date("YmdHis")
        ]);
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
