<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDermatologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dermatologies', function (Blueprint $table) {
             $table->increments('id');
             $table->string('idcomprobante',250);
             $table->string('idpaciente',250);
             $table->string('iddoctor',250);
             $table->date('fecha');
             $table->string('opcion1',5)->nullable();
             $table->text('respuesta_opcion1')->nullable();
             $table->string('opcion2',5)->nullable();
             $table->text('respuesta1_opcion2')->nullable();
             $table->text('respuesta2_opcion2')->nullable();
             $table->string('opcion3',5)->nullable();
             $table->string('opcion4',5)->nullable();
             $table->string('opcion5',5)->nullable();
             $table->text('respuesta_opcion5')->nullable();
             $table->string('opcion6',5)->nullable();
             $table->text('respuesta_opcion6')->nullable();
             $table->string('opcion7',5)->nullable();
             $table->text('respuesta_opcion7')->nullable();
             $table->string('opcion8',5)->nullable();
             $table->string('opcion9',5)->nullable();
             $table->text('respuesta_opcion9')->nullable();
             $table->string('opcion10',5)->nullable();
             $table->string('opcion11',5)->nullable();
             $table->string('opcion12',5)->nullable();
             $table->text('respuesta_opcion12')->nullable();
             $table->string('opcion13',5)->nullable();
             $table->string('opcion14',5)->nullable();
             $table->string('opcion15',5)->nullable();
             $table->text('respuesta_opcion16')->nullable();
             $table->text('respuesta_opcion17')->nullable();
             $table->string('opcion18',5)->nullable();
             $table->string('opcion19',5)->nullable();
             $table->string('opcion20',5)->nullable();
             $table->text('conclusiones')->nullable();
             $table->text('cabeza')->nullable();
             $table->text('tronco')->nullable();
             $table->text('extremidades')->nullable();
             $table->text('wood')->nullable();
             $table->text('nokolsky')->nullable();
             $table->text('descripcion')->nullable();
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
        Schema::dropIfExists('dermatologies');
    }
}
