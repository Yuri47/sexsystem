<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class produtos extends Model
{
    //
      protected $fillable = [
        'produto.id', 'codigo', 'preco',
    ];
    public $timestamps = false;

}
