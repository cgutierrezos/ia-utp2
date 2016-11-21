@extends('templates.banner')


@section('content')

	<header id='<?php echo $id ?>'>
		<h2><?php echo $title ?></h2>
		<p><?php echo $paragraph ?></p>
	</header>
	<span class="image"><img src="{{ asset('imagenes/ia.jpg') }}" alt="" /></span>

@endsection


@section('scrolly')

	<a href="<?php echo $aref ?>" class="goto-next scrolly" style='<?php echo $astyle ?>'><?php echo $atitle ?></a>

@endsection