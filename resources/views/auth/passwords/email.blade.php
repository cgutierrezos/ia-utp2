@extends('layouts.app')

@section('body')

    <div id='main' class='wrapper style1'>
        <div class='container'>                     
            <section>
                <h3>Ingresa Tu Correo Para Enviarte Tu Clave</h3>
                <form method="post" action="/password/sendmail">
                    <div class="row uniform 50%">
                        <div class="12u$">
                            <input type="email" name="email" id="email" value="" placeholder="Email">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong style="color : red">{{ $errors->first('email') }}</strong>
                                </span>
                            @elseif($errors->has('correct'))
                                <span class="help-block">
                                    <strong style="color : green">{{ $errors->first('correct') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row uniform 50%">
                        <div class="12u$">
                            <ul class="actions">
                                <li><input type="submit" value="Enviar" class="special"></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection
