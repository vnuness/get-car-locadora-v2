<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaVeiculo extends Model
{
    protected $table = 'categoria_veiculo';
    protected $fillable = ['name'];

    public function veiculos()
    {
        return $this->hasMany(Veiculos::class);
    }
}
