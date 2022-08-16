<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estudiante extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'tipo_documento',
        'identificacion',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'fecha_nacimiento',
        'grado',
        'etnia',
        'tipo_complementario',
        'institucion_id',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
    public function institucion(){
        return $this->belongsTo(Institucion::class);
    }
}
