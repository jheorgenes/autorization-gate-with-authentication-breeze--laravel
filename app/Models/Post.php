<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    // Aplicando cardinalidade
    // Definindo que cada post pertence a um usuário
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
