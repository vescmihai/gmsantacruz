<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Tramite;

class EstadoTramite extends Model
{
    protected $table = 'estado_tramites';

    protected $fillable = [
        'nombre',
        'descripcion',
        'color',
    ];

    public function tramites(): HasMany
    {
        return $this->hasMany(Tramite::class);
    }
}
