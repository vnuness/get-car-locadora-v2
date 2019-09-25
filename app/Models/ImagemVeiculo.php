<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagemVeiculo extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'imagem_veiculo';
    protected $fillable = ['id_veiculo', 'id_imagem', 'order'];
}
