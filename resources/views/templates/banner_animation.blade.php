@extends('templates.banner')


@section('content')

		
	<ul class="actions" style="text-align: center">
		<li>
			<a id="banimar" class="button big" onclick='inicio_animacion()' style="width: 400px">
				<span id="play_animar" class="glyphicon glyphicon-play" aria-hidden="true"></span> Animar (Automatico)
			</a>
		</li>
		<li>
			<a id="siguiente" class="button big" onclick='animar()' style="width: 400px">
				<span class="glyphicon glyphicon-step-forward" aria-hidden="true"></span> Animar (Manual)
			</a>
		</li>

		
	</ul>

	<ul class="actions" style="text-align: center">
		<li>
			<a class="button special big" onclick='javascript:location.reload()' style="width: 400px">
				<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Recargar Pagina
			</a>
		</li>
		@if($search == 2)
			<li>
				<a class="button special big" href="/animaciones/grafo/get-ruta/<?php echo $grafo ?>" class="button small" style="width: 400px"><span>Animar Otra Ruta</span>
				</a>
			</li>
		@endif
	</ul>

@endsection


