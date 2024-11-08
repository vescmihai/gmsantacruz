<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Tramite;

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
        'direccion',
        'documento_anverso',
        'documento_reverso'
    ];

    public function tramite(): HasOne
    {
        return $this->hasOne(Tramite::class);
    }
}
