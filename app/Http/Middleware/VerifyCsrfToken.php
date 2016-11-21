<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'login', 
        'register', 
        'home', 
        'animaciones/grafo/store', 
        'animaciones/grafo/update/*', 
        'auth/register', 
        'auth/login', 
        'sistema-experto/store',
        'sistema-experto/store-upload',
        'sistema-experto/update/*',
        'password/sendmail',
        'password/reset'

    ];
}
