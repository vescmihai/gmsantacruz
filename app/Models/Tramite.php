<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function tipoLicencia(): BelongsTo {
        return $this->belongsTo(TipoLicencia::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function solicitante(): BelongsTo {
        return $this->belongsTo(Solicitante::class);
    }
}
