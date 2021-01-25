<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 50);
            $table->string('imagem', 50);
            $table->string('ano_lancamento', 4);
            $table->string('temporadas', 2);
            $table->longText('sinopse');
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
        Schema::dropIfExists('series');
    }
}
