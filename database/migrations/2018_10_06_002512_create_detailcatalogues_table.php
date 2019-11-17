<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailcataloguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailcatalogues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('catalogue_id')->unsigned();
            $table->foreign('catalogue_id')
                  ->references('id')->on('catalogues')
                  ->onDelete('cascade');
            $table->string('examens_id',10);
            $table->string('inscrito',4);
            $table->string('estado',4);
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
        Schema::dropIfExists('detailcatalogues');
    }
}
