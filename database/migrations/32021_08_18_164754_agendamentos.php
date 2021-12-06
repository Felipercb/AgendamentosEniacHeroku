<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class agendamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descricao');
            $table->string('nome');
            $table->dateTime('tempo_inicial');
            $table->integer('inicial_segundos');
            $table->dateTime('tempo_final');
            $table->integer('final_segundos');
            $table->boolean('publico')->default(0);
            $table->string('email_conta');

           /* $table->foreignId('agendamentos_id')
            ->references('id')
            ->on('agendamentos');*/

            $table->foreignId('suporte_id')
            ->nullable()
            ->references('id')
            ->on('users');

            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamentos');
    }
}
