<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_exams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',20);
            $table->string('descripcion',220);
            $table->integer('exams_id')->unsigned();
            $table->foreign('exams_id')
                  ->references('id')->on('exams')
                  ->onDelete('cascade');
            $table->char('estado',3);
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
        Schema::dropIfExists('detail_exams');
    }
}
