Click aqui para cambiar tu contraseña: <a href="{{ $link = url('password/reset', $user->confirmation_code).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
