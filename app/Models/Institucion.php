<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Expr\FuncCall;

class Institucion extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = [
        'id',
        'identificacion',
        'telefono',
        'inicio_convenio',
        'nombre',
        'tipo',
        'email',
        'term_id',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
    public function term()
    {
        return $this->belongsTo(Term::class);
    }
}
