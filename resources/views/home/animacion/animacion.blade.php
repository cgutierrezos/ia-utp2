@extends('templates.template2')

@section('title', 'animacion')

@section('body')

	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/arbor-tween.js') }}"></script>
	<script src="{{ asset('js/arbor.js') }}"></script>
	<script src="{{ asset('js/graphics.js') }}"></script>
	<script src="{{ asset('js/renderer.js') }}"></script>
	<script src="{{ asset('js/node.js') }}"></script>
	<script src="{{ asset('js/anodes.js') }}"></script>
	<script src="{{ asset('js/tree_generate.js') }}"></script>
	<script src="{{ asset('js/blind_search.js') }}"></script>
	<script src="{{ asset('js/tree_animation.js') }}"></script>


	@include('templates.nav2')

	@include('templates.banner_animation')


	<div class="row">
		<canvas id="viewport" width="screen.width" height="600"></canvas>
	</div>

	<script type="text/javascript">
		var iniciar_animacion=true
		var animacion=null
		var tree, Treeanimation, Busqueda, node=null

		document.getElementById("body").onresize =resize_canvas() 

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
		

		function resize_canvas(){
            var canvas = document.getElementById("viewport");
            if (canvas.width  < window.innerWidth){
                canvas.width  = window.innerWidth-80
            }

            if (canvas.height < window.innerHeight){
                canvas.height = window.innerHeight-210
            }
        }

		
		

		function inicio(){
			var tipo_busqueda=<?php echo $search ?>;
			if(tipo_busqueda<2){
				tree = new Tree()
				tree.generateTree()
			}
			
			
			//alert("tree: "+tree.raiz.print())
			
			//alert("raiz: "+tree.raiz.print())
			//alert(tree.raiz.print())
			Busqueda=new BusquedaCiega(tree.raiz)
			if(tipo_busqueda==0)
				Busqueda.recorridoAnchura()
			else
				Busqueda.recorridoProfundidad(tree.raiz, [], [])
			//alert("nodo solucion: "+Busqueda.nodesol)

			Treeanimation=new TreeAnimation(tree.raiz)
			Treeanimation.addAll()
			
		}

		function animar(){
			Treeanimation.animation(Busqueda.arcos_recorridos, Busqueda.nodesol)
		}


		var sys = arbor.ParticleSystem(1000, 600,0.5)
		sys.parameters({gravity:true})
		sys.renderer = Renderer("#viewport") 
		inicio()
		

	</script>




	

@endsection

