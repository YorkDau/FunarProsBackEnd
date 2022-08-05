<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'nit',
        'nombre',
        'tipo_id',
        'email',
        'telefono',
        'fecha_convenio',
        'municipio_id',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
    public function documentos(){
        return $this->belongsToMany(Term::class,'documento_id')->withPivot('soporte_documento');
    }
}