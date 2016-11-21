<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Validator;

use App\User;

class registerController extends Controller
{

	public function store(Request $request)
    {
    	
        $rules = [
            'username' => 'required|min:6|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ];


        $input = Input::only(
            'username',
            'email',
            'password',
            'password_confirmation'
        );
        

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
	
        $confirmation_code = str_random(30);

        $user = new User();
        $user->username = Input::get('username');
        $user->email = Input::get('email');
        $user->password = bcrypt(Input::get('password'));
        $user->confirmation_code = $confirmation_code;
  
       
        $user->save();
        
        return redirect('/home');
    }

    
    public function confirm($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if ( ! $user)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        Flash::message('Activacion de la cuenta exitosa.');

        return redirect('/login');
    }


    public function bienvenido(){
        return view('home');
    }

    

}
