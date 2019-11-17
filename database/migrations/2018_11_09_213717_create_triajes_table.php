<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('triajes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('idcomprobante',250);
            $table->string('idpaciente',250);
            $table->string('iddoctor',250);
            $table->date('fecha');
            $table->string('sistolica',50);
            $table->string('diastolica',50);
            $table->string('fcardiaca',50);
            $table->string('fcrespiratoria',50);
            $table->string('sto2',50);
            $table->string('talla',50);
            $table->string('peso',50);
            $table->string('imc',50);
            $table->string('pabodminal',50);
            $table->string('pte',50);
            $table->string('pti',50);
            $table->string('temperatura',50);
            $table->string('cintura',50);
            $table->string('pcadera',50);
            $table->string('icc',50);
            $table->string('ptoraxico',50);
            $table->string('atendido',50);
            $table->string('revisado',50);
            $table->string('auditado',50);
            $table->char('estado',2);
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
        Schema::dropIfExists('triajes');
    }
}
