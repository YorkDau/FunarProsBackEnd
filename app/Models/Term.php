<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Term extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'key',
        'initials',
        'code',
        'term_id',
        'is_active',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function parent()
    {
        return $this->belongsTo(Term::class, 'term_id');
    }
    public function childrens()
    {
        return $this->hasMany(Term::class);
    }
}
