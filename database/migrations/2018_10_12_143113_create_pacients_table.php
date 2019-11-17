<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hc',250);
            $table->string('tipo_documento',3);
            $table->string('nro_documento',12);
            $table->string('ap_paterno',12);
            $table->string('ap_materno',12);
            $table->string('nombres',12);
            $table->string('sexo',3);
            $table->date('fecha_nacimiento');
            $table->integer('edad');
            $table->string('telefono',30);
            $table->string('estado_civil',5);
            $table->string('grado_instruccion',5);
            $table->integer('pais_residenciaactual_id');
            $table->integer('departament_residenciaactual_id');
            $table->integer('province_residenciaactual_id');
            $table->integer('distrit_residenciaactual_id');
            $table->string('direccion_residenciaactual',200);
            $table->integer('pais_nacimiento_id');
            $table->integer('departament_nacimiento_id');
            $table->integer('province_nacimiento_id');
            $table->integer('distrit_nacimiento_id');
            $table->string('direccion_nacimiento',200);
            $table->string('estado',3);










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
        Schema::dropIfExists('pacients');
    }
}
