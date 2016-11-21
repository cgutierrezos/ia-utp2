@extends('templates.template2')

@section('title', 'IA - UTP')

@section('body')

	<div id="page-wrapper">

		<!-- Header -->
		@include('templates.nav2')

		<!-- Banner -->
		@include('templates.banner_welcome', [
			'title' => 'Ruta mas corta', 
			'paragraph' => 'Acorta caminos', 
			'style' => 'display: none', 
			'atitle' => 'siguiente'
		])




		<!-- Four -->
		@include('templates.wrapper_fade_up')

		<!-- Five -->
		@include('templates.wrapper_fade')

		<!-- Footer -->
		@include('templates.footer')

	</div>
@endsection