<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class passwordReset extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'password_resets';

    protected $primaryKey = 'email';

    protected $fillable = [
        'email', 'token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    

}
