<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplinas', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();
            $table->string('bimestres')->nullable();
            $table->foreignId('componente_id')->constrained();
            $table->foreignId('turma_id')->constrained();
            $table->string('peso_trab')->nullable();
            $table->string('peso_ava')->nullable();
            $table->string('peso_1b')->nullable();
            $table->string('peso_2b')->nullable();
            $table->string('peso_3b')->nullable();
            $table->string('peso_4b')->nullable();
            $table->string('conc_a')->nullable();
            $table->string('conc_b')->nullable();
            $table->string('conc_c')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('disciplinas');
    }
}
