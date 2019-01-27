<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phy_log_table', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table_name', 100);
            $table->string('action', 10);
            $table->text('json_content');
            $table->bigInteger('primary_key');
            $table->bigInteger('version');
            $table->index(['table_name', 'primary_key']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phy_log_table');
    }
}
