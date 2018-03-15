<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddspacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addspaces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->index();
            $table->string('description', 800);
            $table->integer('visits', false, true);
            $table->enum('periodicity',['day', 'week' ,'month'])->default('day');
            $table->double('cost', 8,2);
            $table->integer('profit');
            $table->boolean('admin_profit')->default(false);
            $table->integer('editor_id');
            $table->enum('status', ['ACTIVE','PAUSED','CLOSED'])->default('ACTIVE');
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
        Schema::dropIfExists('addspaces');
    }
}
