@extends('layouts.app')

@section('title', 'home')

@section('body')

	

    @include('templates.banner_welcome', [
        'id' => 'inicio',
        'title' => session()->get('title','Inteligencia Artificial'),
        'paragraph' => session()->get('message','la inteligencia exhibida por máquinas'),
        'aref' => '',
        'astyle' => 'display:none',
        'atitle' => 'siguiente'
    ])

    @if(session()->get('title'))
    	<?php session()->forget('title') ?>
    	<?php session()->forget('message') ?>
    @endif

    
@endsection
