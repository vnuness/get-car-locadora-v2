<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locacoes extends Model
{
    protected $table = 'locacoes';

    protected $fillable = ['status_pagamento'];

//    public const UPDATED_AT = false;

    public function statusPedido()
    {
        return $this->belongsTo(StatusPagamento::class, 'status_pagamento', 'id');
    }
}
