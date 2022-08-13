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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nit')->comment('Número de nit de la empresa.');
            $table->string('nombre')->comment('Nombre de la empresa.');
            $table->foreignId('tipo_id')->comment('Llave foranea (relación) de la tabla terms.');
            $table->foreign('tipo_id')->references('id')->on('terms');
            $table->string('email')->comment('Correo electronico de la empresa.');
            $table->string('telefono')->comment('Numero de telefono de la empresa.');
            $table->date('fecha_convenio')->comment('Fecha de inicio de convenio de la empresa.');
            $table->foreignId('municipio_id')->comment('Llave foranea (relación) de la tabla terms.');
            $table->foreign('municipio_id')->references('id')->on('terms');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('empresas_documentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->comment('Llave foranea (relación) de la tabla empresas.');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreignId('documento_id')->comment('Llave foranea (relación) de la tabla terms.');
            $table->foreign('documento_id')->references('id')->on('terms');
            $table->string('soporte_documento');
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
        Schema::dropIfExists('empresas');
    }
};
