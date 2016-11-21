@extends('templates.template2')

@section('title', 'IA - UTP')

@section('body')

	@include('templates.nav2')


	<div id='main' class='wrapper style1'>
		<div class='container'>
			<section>
				<div class="table-wrapper">
				
					<h3>Tabla de Rutas Guardadas</h3>
					<table>
						<thead>
							<tr>
								<th>Inicio</th>
								<th>Destino</th>
								<th>Valor</th>
								<th>Eliminar</th>
							</tr>
						</thead>
						<tbody>
							@foreach($edges as $key => $edge)
								<tr>
									<td><?php echo App\node::find($edge->nodei_id)->name ?></td>
									<td><?php echo App\node::find($edge->nodef_id)->name ?></td>
									<td><?php echo $edge->value ?></td>
									<td>
										<ul class="actions small">
											<li><a href="/node/destroy/<?php echo $edge->id?>" class="button special small" ><span>X</span></a></li>
										</ul>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</section>
			
						
			<section>
				<h3>Ingreso Nueva Ruta</h3>
				<form method="get" action="/tree/store">
					<div class="row uniform 50%">
						<div class="6u 12u$(xsmall)">
							<input type="text" name="inicio" id="inicio" value="" placeholder="Inicio">
						</div>
						<div class="6u$ 12u$(xsmall)">
							<input type="text" name="fin" id="fin" value="" placeholder="Fin">
						</div>
						<div class="12u$">
							<input type="text" name="valor" id="valor" value="" placeholder="Valor">
						</div>
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