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
        'tipo',
        'numero_propuesta',
        'empresa_contratista_id',
        'empresa_beneficiaria_id',
        'nombre',
        'fecha_inicial',
        'estado_id',
        'institucion_id',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
    public function estados()
    {
        return $this->belongsTo(Term::class, 'estado_id', 'id')->withTrashed();
    }
    public function empresaBeneficiaria()
    {
        return $this->belongsTo(Empresa::class, 'empresa_beneficiaria_id', 'id')->withTrashed();
    }
    public function empresas()
    {
        return $this->belongsToMany(Empresa::class, 'propuestas_empresas', 'propuesta_id', 'empresa_id');
    }
    public function instituciones()
    {
        return $this->belongsToMany(Institucion::class, 'propuestas_institucions', 'propuesta_id', 'institucion_id');
    }
}
