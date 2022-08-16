<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Propuesta extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'id',
        'institucion_id',
        'tipo',
        'empresa_id',
        'numero_propuesta',
        'fecha_inicial',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
    public function empresas()
    {
        return $this->belongsToMany(Empresa::class, 'propuestas_empresas', 'propuesta_id', 'empresa_id');
    }
    public function instituciones()
    {
        return $this->belongsToMany(Institucion::class, 'propuestas_instituciones', 'propuesta_id', 'institucion_id');
    }
}
