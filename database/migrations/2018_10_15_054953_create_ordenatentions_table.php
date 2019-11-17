<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenatentionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('ordenatentions', function (Blueprint $table) {
        //      $table->increments('id');
        //      $table->string('servicio',3);
        //      $table->date('fecha');
        //      $table->string('hora_inicio',13);
        //      $table->string('nro_orden',200);
        //      $table->integer('empresa_id')->unsigned();
        //      $table->foreign('empresa_id')
        //            ->references('id')->on('companies');
        //      $table->integer('area_id')->unsigned();
        //      $table->foreign('area_id')
        //            ->references('id')->on('areas');
        //      $table->integer('profile_id')->unsigned();
        //      $table->foreign('profile_id')
        //           ->references('id')->on('profiles');
        //      $table->integer('obra_id')->unsigned();
        //      $table->foreign('obra_id')
        //           ->references('id')->on('obras');
        //     $table->string('tipoexam_id');
        //     $table->string('id_subcontrata',130);
        //     $table->string('idformato',13); 
        //     $table->decimal('subtotal',8, 2);
        //     $table->decimal('igv',8, 2);
        //     $table->decimal('total',8, 2);
        //     $table->text('examenes_vendidos');
        //     $table->string('estado',3);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenatentions');
    }
}
