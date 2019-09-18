<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagens extends Model
{
    protected $table = 'imagens';
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = ['imagem'];
}
