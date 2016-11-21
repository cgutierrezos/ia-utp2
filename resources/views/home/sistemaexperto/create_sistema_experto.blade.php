@extends('layouts.app')

@section('title', 'IA - UTP')

@section('body')

	<div id='main' class='wrapper style1'>
		<div class='container'>
			<section>
				<div class="table-wrapper">
				
					<h3>Tabla de Sistemas Expertos</h3>
					<table>
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Comentarios</th>
								<th>Opciones</th>
							</tr>
						</thead>

						<tbody>
							@foreach($sistemas as $key => $sistema)
								<tr>
									<td><?php echo $sistema->name ?></td>
									<td width="50%"><?php echo $sistema->comments ?></td>
									<td>
										<ul class="actions small">

											<li><a href="/sistema-experto/<?php echo $sistema->id?>/ask" class="button small" ><span>Evaluar</span></a></li>
											
											@if(Auth::check() && $sistema->user_id == Auth::user()->id)
												<li><a href="/sistema-experto/edit/<?php echo $sistema->id?>" class="button small" ><span>Editar</span></a></li>

												<li><a href="/sistema-experto/destroy/<?php echo $sistema->id?>" class="button special small" ><span>Eliminar</span></a></li>
												
												<li><a href="/sistema-experto/download/<?php echo $sistema->id?>" target="_blank" class="button special small icon fa-download"></a></li>
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
					<h3>Ingreso Nuevo Sistema Experto</h3>
					<form method="post" action="/sistema-experto/store" enctype="multipart/form-data">
						<div class="row uniform 50%">
							<div class="12u$">
								<input type="text" name="name" id="name" value="" placeholder="Nombre del Sistema Experto">
								@if ($errors->has('name'))
	                                <span class="help-block">
	                                    <strong style="color : red">{{ $errors->first('name') }}</strong>
	                                </span>
	                            @endif
							</div>
							<div class="12u$">
								<textarea name="comments" id="comments" placeholder="Comentarios del Sistema Experto" rows="3"></textarea>
								@if ($errors->has('comments'))
	                                <span class="help-block">
	                                    <strong style="color : red">{{ $errors->first('comments') }}</strong>
	                                </span>
	                            @endif
							</div>
							
							<div class="12u$">
								<label>Subir La Base Del Conocimiento (.txt)</label>
								<input type="file" name="sistema" id="sistema" accept=".txt">
								@if ($errors->has('text'))
	                                <span class="help-block" >
	                                    <strong style="color : red">{{ $errors->first('text') }}</strong>
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
								Debes Loguearte Para Poder Crear Y Guardar Sistemas Expertos
							</h2>
							<p>
								Mientras Tanto Podras Ver Sistemas Creados Por Otros Usuarios
								Y Verlos En Funcionamiento
							</p>
						</header>
					</section>
				</div>
			@endif
		</div>
	</div>
	

@endsection