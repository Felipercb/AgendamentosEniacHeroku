<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class agendamentosrecaudiovisuais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos_recaudiovisuais', function (Blueprint $table) {
            $table->bigIncrements('id');

        $table->foreignId('recaudiovisuais_id')
        ->references('id')
        ->on('recaudiovisuais');

        $table->foreignId('agendamentos_id')
        ->references('id')
        ->on('agendamentos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamentos_recaudiovisuais');
    }
}
