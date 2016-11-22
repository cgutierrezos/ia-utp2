@extends('layouts.app')

@section('title', 'animacion')

@section('body')

	<section>
		<div class="table-wrapper">
		
			<h3>Tabla de Posibles Rutas</h3>
			<table>
				<thead>
					<tr>
						<th>Inicio</th>
						<th>Destino</th>
						<th>Valor</th>
					</tr>
				</thead>
				<tbody>
					@foreach($edges as $key => $edge)
						<tr>
							<td><?php echo App\node::find($edge->nodei_id)->name ?></td>
							<td><?php echo App\node::find($edge->nodef_id)->name ?></td>
							<td><?php echo $edge->value ?></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</section>

	<section>
		<h3>Ingrese La Ruta Que Desea Animar</h3>
		<form method="get" action="/animaciones/ruta-corta/<?php echo $grafo ?>">
			<div class="row uniform 50%">
				<div class="6u 12u$(xsmall)">
					<input type="text" name="inicio_ruta" id="inicio_ruta" value="" placeholder="Nodo Inicio">
					@if ($errors->has('inicio_ruta'))
                        <span class="help-block">
                            <strong style="color : red">{{ $errors->first('inicio_ruta') }}</strong>
                        </span>
                    @endif
				</div>
			</div>
			<div class="row uniform 50%">
				<div class="6u$ 12u$(xsmall)">
					<input type="text" name="fin_ruta" id="fin_ruta" value="" placeholder="Nodo Fin">
					@if ($errors->has('fin_ruta'))
                        <span class="help-block">
                            <strong style="color : red">{{ $errors->first('fin_ruta') }}</strong>
                        </span>
                    @endif
				</div>
			</div>
			<div class="row uniform 50%">
				<div class="12u$">
					<ul class="actions">
						<li><input type="submit" value="Animar Grafo" class="special"></li>
					</ul>
				</div>
			</div>
		</form>
	</section>
	
@endsection