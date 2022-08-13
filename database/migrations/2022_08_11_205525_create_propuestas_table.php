<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propuestas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institucion_id')->comment('Llave foranea (relación) de la tabla institucions.');
            $table->foreign('institucion_id')->references('id')->on('institucions');
            $table->enum('tipo', ['PAE', 'OBRAS'])->comment('Sector al que pertenece la institución (PAE-OBRAS)');
            $table->foreignId('empresa_id')->comment('Llave foranea (relación) de la tabla empresas.');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->string('numero_propuesta')->comment('Numero de radicado de la propuesta');
            $table->date('fecha_inicial')->comment('Fecha inicial de la creacion de la propuesta');
            $table->softDeletes();
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
        Schema::dropIfExists('propuestas');
    }
};
