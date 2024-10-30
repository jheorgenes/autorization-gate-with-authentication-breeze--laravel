<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    // Definindo quais colunas serão preenchidas quando o sistema for inserir um novo registro no banco de dados
    protected $fillable = ['title', 'content', 'user_id'];

    // Aplicando cardinalidade
    // Definindo que cada post pertence a um usuário
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
