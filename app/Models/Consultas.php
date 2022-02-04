<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultas extends Model
{
    use HasFactory;
    protected $table = 'consultas';
    protected $fillable = [
        'ip',
        'cidade',
        'estado',
        'pais',
        'temperatura',
        'eDia',
        'velocidadeVento',
        'humidadeAr',
        'ultimaAtualizacao'
    ];

}
