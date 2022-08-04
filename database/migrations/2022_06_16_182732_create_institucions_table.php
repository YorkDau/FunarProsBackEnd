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
        Schema::create('institucions', function (Blueprint $table) {
            $table->id();
            $table->string('identificacion',20)->comment('Numero de identificaión de la institución');
            $table->integer('telefono')->default(12)->comment('Numero de contacto de la institución');
            $table->date('inicio_convenio')->comment('Fecha de incio del convenio');
            $table->string('nombre', 100)->comment('Nombre de la institución');
            $table->foreignId('term_id')->comment('Llave foranea (relacion) de la tabla terms.');
            $table->foreign('term_id')->references('id')->on('terms');
            $table->enum('tipo', ['PRIVADO', 'PUBLICO'])->comment('Sector al que pertenece la institución (PUBLICO-PRIVADO)');
            $table->string('email', 100)->nullable()->comment('Correo electronico de la institución');
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
        Schema::dropIfExists('institucions');
    }
};
