<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRangetime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /**
         * 1 - Domingo
         * 2 - Segunda
         * 3 - Terça
         * 4 - Quarta
         * 5 - Quinta
         * 6 - Sexta
         * 7 - Sábado
         */

        Schema::create('rangetime', function (Blueprint $table) {
            $table->id();
            $table->integer('idenvironment');
            $table->integer('day_week');
            $table->integer('seq');
            $table->string('title');
            $table->integer('h_init');
            $table->integer('h_last');
            $table->integer('h_before');
            $table->integer('h_interval');
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });

        DB::table('rangetime')->insert([
            [
                'idenvironment' => 1,
                'day_week' => 2,
                'seq' => 1,
                'title' => 'Horário Segunda',
                'h_init' => 840,
                'h_last' => 1080,
                'h_before' => 10,
                'h_interval' => 8,
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'idenvironment' => 1,
                'day_week' => 4,
                'seq' => 2,
                'title' => 'Horário Quarta Tarde',
                'h_init' => 840,
                'h_last' => 1080,
                'h_before' => 10,
                'h_interval' => 8,
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'idenvironment' => 1,
                'day_week' => 4,
                'seq' => 3,
                'title' => 'Horário Quarta Noite',
                'h_init' => 1200,
                'h_last' => 1320,
                'h_before' => 10,
                'h_interval' => 8,
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'idenvironment' => 1,
                'day_week' => 5,
                'seq' => 4,
                'title' => 'Horário Quinta',
                'h_init' => 840,
                'h_last' => 1080,
                'h_before' => 10,
                'h_interval' => 8,
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'idenvironment' => 1,
                'day_week' => 6,
                'seq' => 4,
                'title' => 'Horário Sexta',
                'h_init' => 1320,
                'h_last' => 1380,
                'h_before' => 10,
                'h_interval' => 8,
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'idenvironment' => 2,
                'day_week' => 2,
                'seq' => 1,
                'title' => 'Horário Segunda',
                'h_init' => 840,
                'h_last' => 1080,
                'h_before' => 10,
                'h_interval' => 8,
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'idenvironment' => 2,
                'day_week' => 4,
                'seq' => 2,
                'title' => 'Horário Quarta Tarde',
                'h_init' => 840,
                'h_last' => 1080,
                'h_before' => 10,
                'h_interval' => 8,
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'idenvironment' => 2,
                'day_week' => 4,
                'seq' => 3,
                'title' => 'Horário Quarta Noite',
                'h_init' => 1200,
                'h_last' => 1320,
                'h_before' => 10,
                'h_interval' => 8,
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'idenvironment' => 2,
                'day_week' => 5,
                'seq' => 4,
                'title' => 'Horário Quinta',
                'h_init' => 840,
                'h_last' => 1080,
                'h_before' => 10,
                'h_interval' => 8,
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'idenvironment' => 2,
                'day_week' => 6,
                'seq' => 4,
                'title' => 'Horário Sexta',
                'h_init' => 1320,
                'h_last' => 1380,
                'h_before' => 10,
                'h_interval' => 8,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rangetime');
    }
}
