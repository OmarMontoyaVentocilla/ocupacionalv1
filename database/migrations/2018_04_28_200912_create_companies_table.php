<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ruc',12);
            $table->string('razon_social',150);
            $table->string('nombre_comercial',150)->nullable();
            $table->string('actividad_economica',150)->nullable();
            $table->string('direccion',150)->nullable();
            $table->integer('departament_id');
            $table->integer('province_id');
            $table->integer('distrit_id');
            $table->char('rubro_mineria',2)->nullable();
            $table->char('rubro_contruccion',2)->nullable();
            $table->char('rubro_industria',2)->nullable();
            $table->char('rubro_comercio',2)->nullable();
            $table->char('rubro_banca',2)->nullable();
            $table->char('rubro_logistico',2)->nullable();
            $table->char('rubro_callcenter',2)->nullable();
            $table->char('rubro_otro',2)->nullable();
            $table->string('telefono_nro1',30)->nullable();
            $table->string('telefono_nro2',30)->nullable();
            $table->string('contacto_nr1',30)->nullable();
            $table->string('contacto_nro2',30)->nullable();
            $table->string('email_nr1',30)->nullable();
            $table->string('email_nr2',30)->nullable();
            $table->date('inicio_facturacion');
            $table->integer('corte_facturacion');
            $table->integer('envio_orden_compra');
            $table->integer('dias_credito');
            $table->string('observacion',130)->nullable();
            $table->date('inscripcion')->nullable();
            $table->char('habilitar_extranet')->nullable();
            $table->char('estado',3);
            $table->string('pagina');
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
        Schema::dropIfExists('companies');
    }
}
