<header id="header">
	<h1 id="logo"><a href="/">INTELIGENCIA ARTIFICIAL</a></h1>
	<nav id="nav">
		<ul>
			<li><a href="/">INICIO</a></li>
			

			
			<li>
				<a href="/algoritmos">ALGORITMOS</a>
			</li>
			<li>
				<a href="">ANIMACIONES</a>
				<ul>
					<li>
						<a href="">Busqueda Ciega</a>
							<ul>
								<li><a href="/animaciones/anchura">Anchura</a></li>
								<li><a href="/animaciones/profundidad">Profundidad</a></li>
							</ul>
					</li>
					<li>
						<a href="">Busqueda Guiada</a>
							<ul>
								<li><a href="/animaciones/grafo/create">Ruta Corta</a></li>
							</ul>
					</li>
					
				</ul>
			</li>
			<li><a href="/sistema-experto/create">SISTEMAS EXPERTOS</a></li>
			

				
			@if(Auth::check())
				<li>
					<a href=""><?php echo Auth::user()->username ?></a>
					<ul>
						<li><a href="/logout">Logout</a></li>
					</ul>
				</li>
			@else
				<li><a href="/login" class="button special">Log In</a></li>
				<li><a href="/register" class="button special">Register</a></li>
			@endif
			<!---->
		</ul>
	</nav>
</header>