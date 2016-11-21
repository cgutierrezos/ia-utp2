var tree, Treeanimation, Busqueda, node=null

function inicio(){
	document.getElementById("siguiente").disabled =false ;
	var tipo_busqueda=<?echo $search;?>
	tree = new Tree()
	tree.generateTree()

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
