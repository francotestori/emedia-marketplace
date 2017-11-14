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
            $table->string('url', 255)->index();
            $table->string('description', 800);
            $table->integer('visits');
            $table->double('cost', 15,2);
            $table->integer('editor_id');
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
