@extends('layouts.app')

@section('title', 'IA - UTP')

@section('body')

	<div id='main' class='wrapper style1'>
		<div class='container'>		
			<section>
				<header class="major">
					@if(session()->get('respuesta') == '')
						<h2>PREGUNTA</h2>
						@foreach(session()->get('pregunta') as $key => $pregunta)
							<p>Usted posee: {{{App\atributo::find($pregunta)->name}}}?</p>

						@endforeach
						{{--<table>
							<thead>
								<tr>
									<th>Respuesta</th>
									<th>Pregunta</th>
								</tr>
							</thead>
							<tbody>
								@foreach(session()->get('respuestas') as $key => $respuestas)
									@foreach($respuestas as $respuesta)
										<tr>
											<td>{{{$key}}}</td>
											<td>{{{$respuesta}}}</td>
										</tr>
									@endforeach
								@endforeach
							</tbody>
						</table>--}}
				</header>
				<ul class="actions" style="text-align: center">
					<li><a href="/sistema-experto/<?php echo $id ?>/ask/si" class="button special" style="display: inline-block">Si</a></li>
					<li><a href="/sistema-experto/<?php echo $id ?>/ask/no" class="button special" style="display: inline-block" >No</a></li>
				</ul>
				@else
					<h2>RESPUESTA</h2>
					<p>{{{session()->get('respuesta')}}}</p>
				@endif
			</section>
		</div>
	</div>
	

@endsection