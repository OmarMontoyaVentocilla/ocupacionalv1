<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion_equipo',100);
            $table->string('estado',3);
            $table->string('modelo',100);
            $table->string('marca',100);
            $table->string('nro_serie',100);
            $table->date('fecha_calibracion');
            $table->integer('specialties_id');
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
        Schema::dropIfExists('equips');
    }
}
