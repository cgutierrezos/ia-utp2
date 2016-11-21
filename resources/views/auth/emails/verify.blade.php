<h1>Bienvenid@ {{$data['username']}}</h1>
<a href="{{url('/auth/confirm/email/'.$data['email']."/confirm_token/".$data['confirmation_code'])}}">Confirmar mi cuenta</a>