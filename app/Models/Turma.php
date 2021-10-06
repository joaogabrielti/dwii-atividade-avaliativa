<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Turma extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome', 'ano', 'abreviatura', 'curso_id'
    ];

    public function curso() {
        return $this->belongsTo(Curso::class);
    }
}
