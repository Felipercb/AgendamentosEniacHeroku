<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class configuracaohorarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracaohorarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('abertura');
            $table->time('fechamento');
            $table->time('periodo');
            $table->integer('id_semana');
            $table->boolean('disponivel')->default(1);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuracaohorarios');
    }
}
