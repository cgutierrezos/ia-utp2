<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Mail;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\EmailFormRequest;
use App\Http\Requests\ResetFormRequest;
use App\Http\Requests;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;



    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $loginPath = '/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }


    public function getCredentials(Request $request)
    {
        $credentials = $request->only($this->loginUsername(), 'password');

        return array_add($credentials, 'confirmed', '1');
    }

    public function authenticated(Request $request, User $user)
    {
        if ($user->confirmed) {
            return redirect()->intended($this->redirectPath());
        } else {
            return redirect()->back()->withInput()->withErrors('email','sorry, this user account is deactivated');;
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $confirmation_code=str_random(100);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'confirmation_code' => $confirmation_code
        ]);


        return redirect('/');


    }


    public function postReset(ResetFormRequest $request) {

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
 
        $response = $this->passwords->reset($credentials, function($user, $password)
        {
            $user->password = crypt($password);
 
            $user->save();
 
            $this->auth->login($user);
        });
 
        switch ($response)
        {
            case PasswordBroker::PASSWORD_RESET:
                return redirect('/');
 
            default:
                return redirect()->back()
                            ->withInput($request->only('email'))
                            ->withErrors(['email' => trans($response)]);
        }
        
    }


    public function postRegister(Request $request){
        
        $rules = [
            'username' => 'required|min:3|max:16|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|max:18|confirmed',
        ];
        
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $user = new User();
            $data['username'] = $user->username = $request->username;
            $data['email'] = $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $data['confirmation_code'] = $user->confirmation_code = str_random(100);
            $user->save();
            
            Mail::send('auth.emails.verify', ['data' => $data], function($mail) use($data){
                $mail->subject('Confirma tu cuenta');
                $mail->to($data['email'], $data['username']);
            });
            
            session()->put('title', 'Registro Exitoso');
            session()->put('message', 'Se ha enviado el link de confirmacion de la cuenta al correo!!');
            return redirect("/");
        }         
        
    }


    public function confirmRegister($email, $confirm_token){
        $user = new User();
        $the_user = $user->select()->where('email', '=', $email)->where('confirmation_code', '=', $confirm_token)->get();

        if (count($the_user) > 0){
        $active = 1;
        $confirmation_code = str_random(100);
        $user->where('email', '=', $email)->update(['confirmed' => $active, 'confirmation_code' => $confirm_token]);
        session()->put('title', 'Bienvenido ' . $the_user[0]['username']);
        session()->put('message', 'Enhorabuena ' . ' ya puede iniciar sesión');
        return redirect('/');
        }
        else
        {
            
            session()->put('title', 'Error ' . $the_user[0]['username']);
            session()->put('message', 'Ocurrio un error tratando de verificar la cuenta');
            return redirect('/');
        }
    }


    



    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */

    
 
}
