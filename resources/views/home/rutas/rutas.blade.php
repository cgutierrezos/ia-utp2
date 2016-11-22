@extends('templates.template2')

@section('title', 'IA - UTP')

@section('body')

	
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

@endsection