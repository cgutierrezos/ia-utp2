<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class sessionController extends Controller
{
    
    public function store()
    {
        $rules = [
            'username' => 'required|exists:users',
            'password' => 'required'
        ];

        $input = Input::only('username', 'email', 'password');

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $credentials = [
            'username' => Input::get('username'),
            'password' => Input::get('password'),
            'confirmed' => 1
        ];

        if ( ! Auth::attempt($credentials))
        {
            return Redirect::back()
                ->withInput()
                ->withErrors([
                    'credentials' => 'No hemos podido identificarte.'
                ]);
        }

        Flash::message('Bienvenido!');

        return redirect('/');
    }
}
