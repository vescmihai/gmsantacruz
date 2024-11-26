<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Tramite;
use App\Models\User;

class Licencia extends Model
{
    protected $table = 'licencias';

    protected $fillable = [
        'documento',
        'valido_hasta',
        'tramite_id',
        'user_id'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function tramite(): BelongsTo {
        return $this->belongsTo(Tramite::class);
    }
}
