<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkempclient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linkempclient', function (Blueprint $table) {
            $table->id()->unique();
            $table->integer('user_emp');
            $table->integer('client');
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
        Schema::dropIfExists('linkempclient');
    }
}
