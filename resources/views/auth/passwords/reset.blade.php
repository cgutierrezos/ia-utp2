@extends('layouts.app')

@section('title', "Bienvenido")

@section('body')
    <div id='main' class='wrapper style1'>
        <div class='container'>                     
            <section>
                <h3>Cambia Tu Contraseña</h3>
                <form method="post" action="/password/reset">
                    <input type="hidden" id='token' name="token" value="{{ $token }}">
                    <div class="row uniform 50%">
                        <div class="12u$">
                            <input type="email" name="email" id="email" value="" placeholder="Email">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong style="color : red">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="12u$">
                            <input type="password" name="password" id="password" value="" placeholder="Clave">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong style="color : red">{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="12u$">
                            <input type="password" name="password_confirmation" id="password_confirmation" value="" placeholder="Confirme la Clave">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong style="color : red">{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row uniform 50%">
                        <div class="12u$">
                            <ul class="actions">
                                <li><input type="submit" value="Guardar" class="special"></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>

   
       

@endsection

