<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramasAquecimento extends Model
{
    use HasFactory;

    protected $table = 'programas_aquecimentos';

    protected $fillable = [
        'nome',
        'alimento',
        'tempo',
        'potencia',
        'instrucoes'
    ];
}
