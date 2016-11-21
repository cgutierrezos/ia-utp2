<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class objeto_atributo extends Model
{
    protected $table = 'objetos_atributos';

    protected $fillable = ['sistema_id', 'objeto_id', 'atributo_id'];

    public function objeto(){
    	return $this->belongsTo('App\objeto');
    }

    public function sistemasexpertos(){
    	return $this->hasMany('App\sistemaexperto');
    }

    public function atributo(){
    	return $this->belongsTo('App\atributo');
    }

}
