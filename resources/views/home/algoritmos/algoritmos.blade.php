@extends('layouts.app')

@section('title', 'Algoritmos')

@section('body')


        <!-- Header -->
        @include('templates.nav2')

        <!-- Banner -->
        @include('templates.banner_welcome', [
            'id' => 'inicio',
            'title' => 'Algoritmos de busqueda', 
            'paragraph' => 'Está diseñado para localizar un elemento con ciertas propiedades dentro de una estructura de datos',
            'aref' => '#uno',
            'astyle' => 'display: inline', 
            'atitle' => 'siguiente'
            ])

        <!-- One -->
        @include('templates.spotlight_bottom', [
            'id' => 'uno',
            'title' => 'Algoritmo de busqueda',
            'paragraph' => '',
            'paragraph1' => 'Un algoritmo de búsqueda es aquel que está diseñado para localizar un elemento concreto dentro de una estructura de datos. Consiste en solucionar un problema de existencia o no de un elemento determinado en un conjunto finito de elementos, es decir, si el elemento en cuestión pertenece o no a dicho conjunto, además de su localización dentro de éste.
                Este problema puede reducirse a devolver la existencia de un número en un vector.',
            'paragraph2' => 'La búsqueda ciega o no informada sólo utiliza información acerca de si un estado es o no objetivo para guiar su procesu de búsqueda.
                Los métodos de búsqueda ciega se pueden clasificar en dos grupos básicos',
            'aref' => '#dos',
            'astyle' => 'display:inline',
            'atitle' => 'siguiente',
        ])

        <!-- Two -->
        @include('templates.spotlight_right', [
            'id' => 'dos',
            'title' => 'Busqueda en anchura',
            'paragraph' => '',
            'paragraph1' => 'Son procedimientos de búsqueda nivel a nivel. Para cada uno de los nodos de un nivel se aplican todos los posibles operadores y no se expande ningún nodo de un nivel antes de haber expandido todos los del nivel anterior.',
            'liref' => '/algoritmo/busqueda-anchura',
            'listyle' => 'display:none',
            'lititle' => 'MAS',
            'aref' => '#tres',
            'astyle' => 'display:inline',
            'atitle' => 'siguiente'
        ])   

        <!-- Three -->
        @include('templates.spotlight_left',[
            'id' => 'tres',
            'title' => 'Busqueda en profundidad',
            'paragraph' => '',
            'paragraph1' => 'En estos procedimientos se realiza la búsqueda por una sola rama del árbol hasta encontrar una solución o hasta que se tome la decisión de terminar la búsqueda por esa dirección ( por no haber posibles operadores que aplicar sobre el nodo hoja o por haber alcanzado un nivel de profundidad muy grande ) . Si esto ocurre se produce una vuelta atrás ( backtracking ) y se sigue por otra rama hasta visitar todas las ramas del árbol si es necesario.',
            'liref' => '/algoritmo/busqueda-profundidad',
            'listyle' => 'display:none',
            'lititle' => 'MAS',
            'aref' => '',
            'astyle' => 'display:none',
            'atitle' => 'siguiente'
        ])


    

        <!-- Footer -->
        @include('templates.footer')


   
@endsection