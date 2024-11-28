<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User;
use App\Models\Tramite;

class Notificacion extends Model
{
    protected $table = 'notificaciones';

    protected $fillable = [
        'titulo',
        'mensaje',
        'enlace',
        'user_id',
        'tramite_id',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function tramite(): BelongsTo {
        return $this->belongsTo(Tramite::class);
    }
}
