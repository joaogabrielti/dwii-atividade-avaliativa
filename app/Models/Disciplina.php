<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disciplina extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome', 'bimestres', 'componente_id', 'turma_id',
        'peso_trab', 'peso_ava', 'peso_1b', 'peso_2b', 'peso_3b', 'peso_4b',
        'conc_a', 'conc_b', 'conc_c'
    ];

    public function componente() {
        return $this->belongsTo(Componente::class);
    }

    public function turma() {
        return $this->belongsTo(Turma::class);
    }
}
