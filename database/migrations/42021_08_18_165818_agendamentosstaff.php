<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class agendamentosstaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos_staff', function (Blueprint $table) {
            $table->bigIncrements('id');


        $table->foreignId('staff_id')
        ->references('id')
        ->on('staff');

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
        Schema::dropIfExists('agendamentos_staff');
    }
}
