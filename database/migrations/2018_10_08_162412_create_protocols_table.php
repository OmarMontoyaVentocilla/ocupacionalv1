<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocols', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')
                  ->references('id')->on('companies');
            $table->string('subcontrata',10);
            $table->string('descripcion',200);
            $table->integer('perfil_id')->unsigned();
            $table->foreign('perfil_id')
                  ->references('id')->on('profiles');
            $table->string('estado_protocolo',3);
            $table->date('vigencia_inicial');
            $table->date('vigencia_final');
            $table->decimal('total_preocupacional',8, 2);
            $table->decimal('total_periodico',8, 2);
            $table->decimal('total_retiro',8, 2);
            $table->decimal('total_visita',8, 2);
            $table->decimal('total_reubicacion',8, 2);
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
        Schema::dropIfExists('protocols');
    }
}
