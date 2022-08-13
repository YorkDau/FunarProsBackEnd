<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Empleado extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'id',
        'tipo_identificacion_id',
        'identificacion',
        'fecha_expedicion_documento',
        'nombres',
        'apellidos',
        'numero_telefono',
        'genero_id',
        'email',
        'fecha_nacimiento',
        'ocupacion',
        'nivel_escolaridad_id',
        'direccion',
        'soporte_documento',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function genero()
    {
        return $this->belongsTo(Term::class, 'genero_id', 'id');
    }
        public function documento()
    {
        return $this->belongsTo(Term::class, 'tipo_identificacion_id', 'id');
    }
        public function escolaridad()
    {
        return $this->belongsTo(Term::class, 'nivel_escolaridad_id', 'id');
    }
}
