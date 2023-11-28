<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $table = 'alunos';

    protected $fillable = [
        'nome',
        'descricao',
        'contratado',
        'curso_id',
        'imagem',
    ];

    public function curso(){
        return $this->belongsTo(Curso::class, 'curso_id');
    }
}
