<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Tramite;

class TipoLicencia extends Model
{
    protected $table = 'tipo_licencias';

    protected $fillable = [
        'nombre',
        'descripcion',
        'codigo',
        'icono',
    ];

    public function tramites(): HasMany
    {
        return $this->hasMany(Tramite::class);
    }
}
