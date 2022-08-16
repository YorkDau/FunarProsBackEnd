<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Extension\Table\Table;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento')->comment('Tipo de documento del estudiante');
            $table->string('identificacion')->comment('Número de identificación del estudiante');
            $table->string('primer_nombre')->comment('Primer nombre del estudiante');
            $table->string('segundo_nombre')->comment('Segundo nombre del estudiante');
            $table->string('primer_apellido')->comment('Primer apellido del estudiante');
            $table->string('segundo_apellido')->comment('Segundo apellido del estudiante');
            $table->date('fecha_nacimiento')->comment('Fecha de nacimiento del estudiante');
            $table->string('etnia')->comment('Tipo de etnia del estudiante');
            $table->string('grado')->comment('Grado del estudiante');
            $table->string('tipo_complementario')->comment('tipo de complemento alimentario');
            $table->foreignId('institucion_id')->comment('Llave foranea (relación) de la tabla institucions.');
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
        Schema::dropIfExists('estudiantes');
    }
};
