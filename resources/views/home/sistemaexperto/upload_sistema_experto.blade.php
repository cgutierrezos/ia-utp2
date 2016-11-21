@extends('layouts.app')

@section('title', 'IA - UTP')

@section('body')

	<div id='main' class='wrapper style1'>
		<div class='container'>			
						
			<section>
				<h3>Seleccione el archivo del sistema experto</h3>
				<form method="post" action="/sistema-experto/store-upload" accept-charset="UTF-8" enctype="multipart/form-data">
					<div class="row uniform 50%">
						<div class="6u 12u$(xsmall)">
							<input type="text" name="name" id="name" value="" placeholder="Nombre del Sistema Experto">
							@if ($errors->has('name'))
                                <span class="help-block">
                                    <strong style="color : red">{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
						</div>
					</div>
					<div class="row uniform 50%">
						<div class="6u 12u$(xsmall)">
							<input type="text" name="comments" id="comments" value="" placeholder="Comentarios del Sistema Experto">
							@if ($errors->has('comments'))
                                <span class="help-block">
                                    <strong style="color : red">{{ $errors->first('comments') }}</strong>
                                </span>
                            @endif
						</div>
					</div>
					<div class="row uniform 50%">
						<div class="12u">
							<input type="file" name="sistema" id="sistema" accept=".txt">
							@if ($errors->has('text'))
                                <span class="help-block" >
                                    <strong style="color : red">{{ $errors->first('text') }}</strong>
                                </span>
                            @endif
						</div>
					</div>
					<div class="row uniform 50%">
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