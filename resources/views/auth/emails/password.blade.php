<h3>Sistema de Declaración Jurada Vehicular en Línea</h3>
<p>Estimado contribuyente</p>
<p>En atención a su solicitud de cambio de contraseña, le enviamos el enlace de restablecimento.</p> 
<p>Click en el siguiente enlace cambiar su contraseña: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a></p>
