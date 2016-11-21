<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class node extends Model
{
    //

    protected $table = 'nodes';

    protected $fillable = ['grafo_id','name','value'];

    public function grafo(){
    	return $this->belongsTo('App\grafo');
    }

    public function edges(){
    	return $this->hasMany('App\edge');
    }
}
