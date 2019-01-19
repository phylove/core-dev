<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phy_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 50)->unique();
            $table->string('email', 100)->unique();
            $table->string('password', 200);
            $table->bigInteger('version');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->bigInteger('created_at');
            $table->bigInteger('updated_at');

        });

        DB::table('phy_users')->insert([
            'username' => 'superuser',
            'email' => 'superuser@localhost',
            'password' => password_hash('superuser', PASSWORD_BCRYPT),
            'version' => 0,
            'created_by' => -1,
            'updated_by' => -1,
            'created_at' => -1,
            'updated_at' => -1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_user');
    }
}
