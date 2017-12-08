<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NovoPreco extends Model
{
    //
     protected $fillable = [
        'id', 'idProduto', 'idUser', 'novoPreco',
    ];
    public $timestamps = false;

}
