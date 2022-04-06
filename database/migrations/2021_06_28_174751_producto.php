<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Producto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tiposdeproductos', function (Blueprint $table) {
            $table->id();
            $table->string('clasificacion');
            $table->timestamps();
        });
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('Descripcion');
            $table->string('foto');
            $table->string('foto2');
            $table->string('foto3');
            $table->timestamps();
            $table->string('Estado_actual_del_producto');
            //user
            $table->unsignedBigInteger('id_usuario')->index();
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            //tipo
            $table->unsignedBigInteger('id_tiposdeproductos')->unsigned();
            $table->foreign('id_tiposdeproductos')->references('id')->on('tiposdeproductos');


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tiposdeproductos');
        Schema::dropIfExists('productos');
    }
}
