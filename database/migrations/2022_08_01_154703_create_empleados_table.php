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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_identificacion_id')->comment('Llave foranea (relacion) de la tabla terms.');
            $table->foreign('tipo_identificacion_id')->references('id')->on('terms');
            $table->string('identificacion')->comment('Numero de identificacion del empleado');
            $table->date('fecha_expedicion_documento')->comment('Fecha de expedicion del documento del empleado');
            $table->string('nombres')->comment('Primer y segundo nombre del empleado');
            $table->string('apellidos')->comment('Apellidos del empleado');
            $table->string('numero_telefono')->comment('Numero de telefono del empleado');
            $table->foreignId('genero_id')->comment('Llave foranea (relacion) de la tabla terms.');
            $table->foreign('genero_id')->references('id')->on('terms');
            $table->string('email', 100)->nullable()->comment('Correo electronico del empleado');
            $table->date('fecha_nacimiento')->comment('Fecha de nacimiento del empleado');
            $table->string('ocupacion')->comment('Nombre del cargo del empleado');
            $table->foreignId('nivel_escolaridad_id')->comment('Llave foranea (relacion) de la tabla terms.');
            $table->foreign('nivel_escolaridad_id')->references('id')->on('terms');
            $table->string('direccion')->comment('Dirección de residencia del empleado');
            $table->string('soporte_documento')->comment('Ruta del documento del empleado');
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
        Schema::dropIfExists('empleados');
    }
};
