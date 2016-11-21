@extends('layouts.app')

@section('title', "Bienvenido")

@section('body')

    @include('templates.banner_welcome', [
        'id' => 'inicio',
        'title' => 'Bienvenido',
        'paragraph' => 'Intenta loguearte con tu nuevo password!',
        'aref' => '',
        'astyle' => 'display:none',
        'atitle' => 'siguiente'
    ])

@endsection
