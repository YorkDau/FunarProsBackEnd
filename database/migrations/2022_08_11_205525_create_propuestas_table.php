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
            $table->enum('tipo', ['CONTRATO PAE', 'CONTRATO OBRAS'])->comment('Tipo de contrato (PAE-OBRAS)');
            $table->string('estado_id')->comment('Estado de la propuesta')->nullable();
            $table->string('nombre')->comment('Nombre de la propuesta');
            $table->string('empresa_contratista_id')->comment('Id de la empresa contratista');
            $table->string('empresa_beneficiaria_id')->comment('Id de la la empresa beneficiaria');
            $table->string('numero_propuesta')->comment('Numero de radicado de la propuesta');
            $table->date('fecha_inicial')->comment('Fecha inicial de la creacion de la propuesta');

            $table->softDeletes();
            $table->timestamps();
        });
        /*Schema::create('propuestas_empresas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('propuesta_id')->comment('Llave foranea (relación) de la tabla propuestas.');
            $table->foreign('propuesta_id')->references('id')->on('propuestas');
            $table->foreignId('empresa_id')->comment('Llave foranea (relación) de la tabla empresas.');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->softDeletes();
            $table->timestamps();
        });
        */

        Schema::create('propuestas_institucions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('propuesta_id')->comment('Llave foranea (relación) de la tabla propuestas.');
            $table->foreign('propuesta_id')->references('id')->on('propuestas');
            $table->foreignId('institucion_id')->comment('Llave foranea (relación) de la tabla instituciones.');
            $table->foreign('institucion_id')->references('id')->on('institucions');
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
