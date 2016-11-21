@extends('layouts.app')

@section('title', 'IA - UTP')

@section('body')

	<div id='main' class='wrapper style1'>
		<div class='container'>
			<section>
				<div class="table-wrapper">
				
					<h3>Tabla de Grafos Guardados</h3>
					<table>
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Comentarios</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($grafos as $key => $grafo)
								<tr>
									<td width="15%"><?php echo $grafo->name ?></td>
									<td width="35%"><?php echo $grafo->comments ?></td>
									<td>
										<ul class="actions small">

											<li><a href="/animaciones/grafo/get-ruta/<?php echo $grafo->id ?>" class="button small" ><span>Animar</span></a></li>

											@if(Auth::check() && $grafo->user_id == Auth::user()->id)
												<li><a href="/animaciones/grafo/edit/<?php echo $grafo->id?>" class="button small" ><span>Editar</span></a></li>

												<li><a href="/animaciones/grafo/destroy/<?php echo $grafo->id?>" class="button special small" ><span>Eliminar</span></a></li>
											@endif
										</ul>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</section>
			
				
			@if(Auth::check())		
				<section>
					<h3>Ingreso Nuevo Grafo</h3>
					<form method="post" action="/animaciones/grafo/store">
						<div class="row uniform 50%">
							<div class="12u$">
								<input type="text" name="name" id="name" value="" placeholder="Nombre del Grafo">
								@if ($errors->has('name'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('name') }}</strong>
	                                </span>
	                            @endif
							</div>
							<div class="12u$">
								<textarea name="comments" id="comments" placeholder="Comentarios del Grafo" rows="3"></textarea>
								@if ($errors->has('comments'))
	                                <span class="help-block">
	                                    <strong style="color : red">{{ $errors->first('comments') }}</strong>
	                                </span>
	                            @endif
							</div>
							<div class="12u$">
								<ul class="actions">
									<li><input type="submit" value="Guardar" class="special"></li>
								</ul>
							</div>
						</div>
					</form>
				</section>
			@else
				<div class='container'>		
					<section>
						<header class="major">
							<h2>
								Debes Loguearte Para Poder Crear Y Guardar Grafos
							</h2>
							<p>
								Mientras Tanto Podras Ver Grafos Creados Por Otros Usuarios
								Y Animarlos Como Quieras
							</p>
						</header>
					</section>
				</div>
			@endif
			</div>
		</div>

	

@endsection