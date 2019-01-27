<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phy_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role_code', 50)->unique();
            $table->string('role_name', 100);
            $table->string('role_description', 255);
            $table->bigInteger('version');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->bigInteger('created_at');
            $table->bigInteger('updated_at');
        });

        DB::table('phy_roles')->insert([
            'id' => -1,
            'role_code' => 'superUser',
            'role_name' => 'Super User',
            'role_description' => 'Super User have fully task on the system',
            'version' => 0,
            'created_by' => -1,
            'updated_by' => -1,
            'created_at' => date("YmdHis"),
            'updated_at' => date("YmdHis")
        ]);

        DB::table('phy_roles')->insert([
            'role_code' => 'regularUser',
            'role_name' => 'Regular User',
            'role_description' => 'Regular User',
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
        Schema::dropIfExists('phy_roles');
    }
}
