<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculos extends Model
{
    protected $table = 'veiculo';
    protected $fillable = ['modelo', 'montadora', 'ano', 'placa', 'renavam', 'id_combustivel', 'id_cambio', 'id_status', 'acessorios', 'id_status_atividade', 'imagem', 'valor_diaria', 'id_categoria', 'descricao'];
    const UPDATED_AT = null;
    const CREATED_AT = null;


//    public function categoria_veiculo()
//    {
//        return $this->belongsToMany(CategoriaVeiculo::class);
//    }

    public function categoria()
    {
        return $this->belongsTo(CategoriaVeiculo::class, 'id_categoria', 'id');
    }
}
