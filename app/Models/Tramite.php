<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Solicitante;
use App\Models\TipoLicencia;
use App\Models\User;

class Tramite extends Model
{
    protected $table = 'tramites';

    protected $fillable = [
        'codigo',
        'user_id',
        'solicitante_id',
        'tipo_licencia_id'
    ];

    public function tipoLicencia(): HasOne {
        return $this->hasOne(TipoLicencia::class);
    }

    public function user(): HasOne {
        return $this->hasOne(User::class);
    }

    public function solicitante(): HasOne {
        return $this->hasOne(Solicitante::class);
    }
}
