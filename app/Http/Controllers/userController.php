<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use Illuminate\Support\Facades\Config;
use App\Http\Requests;

use App\User;
use App\session;
use App\passwordReset;


use Validator;
use Auth;


class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.login.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $user = new User();
        $user->name = $request->usuario;
        $user->email = $request->email;
        $user->password = $request->clave;
        $user->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $user = User::where('name', $request->usuario)->where('password', $request->clave)->first();
        if(is_object($user)){
            $session =new session();
            $session->user_id=$user->id;

            return redirect('/');
        }else{
            return back()->withInput();
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function resetPassword($token){
        $user = User::where('confirmation_code', $token)->get()->first();
        if ($user) {
            echo "token";
            var_dump($token);
            var_dump($user->username);
            var_dump($user->token);

            //return view('auth.passwords.reset', ['token' => $token]);
        }else{
            session()->put('title', 'Error');
            session()->put('message', 'El token de confirmacion es invalido');
            return redirect('/');
        }
        
    }

    public function forgotPassword(){
        return view('auth.passwords.email');
    }

    public function sendMail(Request $request){
        
        $v = Validator::make($request->all(), [
            'email' => 'required|email|exists:users'
        ]);
 
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $user = User::where('email', $request->email)->first();
        if ($user->confirmed) {
            $password = new passwordReset();
            $password->email = $user->email;
            $password->token = $user->confirmation_code;
            $password->save();

            Mail::send('auth.emails.password', ['user' => $user], function($message) use($request)
                {
                    $message->to($request->email, User::where('email', $request->email)->first()->username)->subject('Recuperacion de la clave!');
                });

            return redirect()->back()->withInput([Input::get('email')])->withErrors(array('correct' => 'Se envio correctamente'));
        }else{
            return redirect()->back()->withInput([Input::get('email')])->withErrors(array('email' => 'Esta cuenta aun no se ha confirmado'));
        }
    }
}
