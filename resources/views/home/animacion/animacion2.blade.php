@extends('layouts.app')

@section('title', 'animacion')

@section('body')


	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('plugins/vis/dist/vis.js') }}"></script>
	<script src="{{ asset('plugins/vis/examples/googleAnalytics.js') }}"></script>
	<script src="{{ asset('js/node.js') }}"></script>
	<script src="{{ asset('js/edge.js') }}"></script>
	<script src="{{ asset('js/grafo.js') }}"></script>
	<script src="{{ asset('js/busqueda_ciega.js') }}"></script>
	<script src="{{ asset('js/busqueda_guiada.js') }}"></script>
	<script src="{{ asset('js/grafo_animacion.js') }}"></script>
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/vis/dist/vis.css') }}">
	
	<style type="text/css">
	    #mynetwork {
	      width: 600px;
	      height: 600px;
	      border: 1px solid lightgray;
	    }
	    p {
	      max-width:600px;
	    }

	    

	    html,body{

			margin:0px;

			height:100%;

		}

  	</style>

	@include('templates.banner_animation')

	<div id="mynetwork"  style="background-color: #FFFFFF; width:90%; height:95%; margin-left: 5%; margin-right: 5%; margin-bottom: 5%; border-style: inset;">
		
	</div>

	
	<script type="text/javascript">

		

		var iniciar_animacion=true
		var animacion=null
		var cont=false
		var ruta=null
		var grafo, grafo_animacion, Busqueda, node, container, tipo_busqueda=null

		

		function inicio_animacion(){
			if(iniciar_animacion){
				animacion=window.setInterval(animar, 2000)
				iniciar_animacion=false
				document.getElementById("banimar").innerHTML = '<span id="play_animar" class="glyphicon glyphicon-pause" aria-hidden="true"></span> Detener Animacion (Aut)';
				
				//document.getElementById("banimar").innerHTML = "Detener Animacion (Aut)";
			}
			else{
				clearInterval(animacion)
				iniciar_animacion=true
				document.getElementById("banimar").innerHTML = '<span id="play_animar" class="glyphicon glyphicon-play" aria-hidden="true"></span> Iniciar Animacion (Aut)';
				//document.getElementById("banimar").innerHTML = "Iniciar Animacion (Aut)";
			}
		}
		


		
		

		

		function animar(){
			if(tipo_busqueda<2){
				grafo_animacion.animationCiega(Busqueda.getArcosRecorridos(), Busqueda.getNodoSolucion())
			}else{
				if(!cont){
					ruta=Busqueda.getDijkstra().getRuta()
					cont=true
				}
				grafo_animacion.animationGuiada(ruta)
			}
			
			
		}


		// create a network
		container = document.getElementById('mynetwork');
		tipo_busqueda=<?php echo $search ?>;

		grafo = new Grafo()
		if(tipo_busqueda<2){
			grafo.generateRandomGrafo()
			
		}else{
			var snodes=<?php echo json_encode($nodes) ?>;
			var sedges=<?php echo json_encode($edges) ?>;
			grafo.generateSavedGrafo(snodes, sedges)
			
		}

		
		
		grafo_animacion=new GrafoAnimacion(grafo)
		grafo_animacion.addAll()

		

		

		
		if(tipo_busqueda==0){
			Busqueda=new BusquedaCiega(grafo)
			Busqueda.recorridoAnchura(grafo.getNodes().getNodeByName("RAIZ"))
		}else if(tipo_busqueda==1){
			Busqueda=new BusquedaCiega(grafo)
			Busqueda.recorridoProfundidad(grafo.getNodes().getNodeByName("RAIZ"))
		}else if(tipo_busqueda==2){
			Busqueda=new BusquedaGuiada(grafo)

			var inicio="<?php echo $inicio ?>"
			var fin="<?php echo $fin ?>"
			Busqueda.recorridoRutaCorta(grafo.getNodes().getNodeByName(inicio), grafo.getNodes().getNodeByName(fin))
		}
		
		var data = {
		    nodes: grafo_animacion.getVisNodes(),
		    edges: grafo_animacion.getVisEdges()
		};
		var options = {};
		var network = new vis.Network(container, data, options);
		
		

	</script>






	

@endsection

