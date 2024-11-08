<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    protected $table = 'solicitantes';

    protected $fillable = [
        'tipo',
        'nro_documento',
        'nombres',
        'primer_apellido',
        'segundo_apellido',
        'tercer_apellido',
        'documento_anverso',
        'documento_reverso'
    ];
}
