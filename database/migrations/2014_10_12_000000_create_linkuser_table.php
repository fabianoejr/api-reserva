<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linkuser', function (Blueprint $table) {
            $table->id()->unique();
            $table->integer('client');
            $table->string('name');
            $table->string('email');
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('linkuser');
    }
}
