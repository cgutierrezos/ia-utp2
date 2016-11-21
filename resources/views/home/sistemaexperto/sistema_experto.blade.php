@extends('layouts.app')

@section('title', 'IA - UTP')

@section('body')

	<div id='main' class='wrapper style1'>
		<div class='container'>		
			<section>
				<h3>Ingreso Nuevo Objeto</h3>
				<form method="post" action="/sistema-experto/update/<?php echo $sistema->id ?>" enctype="multipart/form-data">
					<div class="row uniform 50%">
						<div class="12u$">
							<input type="text" name="objeto" id="objeto" value="" placeholder="Nombre del Objeto">
							@if ($errors->has('objeto'))
                                <span class="help-block">
                                    <strong style="color : red">{{ $errors->first('objeto') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="12u$">
							<textarea name="atributos" id="atributos" placeholder="Atributos del objeto separados por un salto de linea ejemplo: 
atributo1
natributo2
natributo3
...
atributoN" rows="6"></textarea>
							@if ($errors->has('atributos'))
                                <span class="help-block">
                                    <strong style="color : red">{{ $errors->first('atributos') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="12u">
							<label>Subir La Base Del Conocimiento (.txt), Si Selecciona Un Archivo Se Omiten Los Campos Anteriores</label>
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
		</div>
	</div>
	

@endsection