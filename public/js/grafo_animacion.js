function GrafoAnimacion(grafo){
	this.grafo=grafo
  	this.vis_nodes=new vis.DataSet([])
  	this.vis_edges=new vis.DataSet([])
	this.fin_animacion=false
	this.edge_cont=0
	this.solucion="[- "
	this.min_distancia=0

	this.setGrafo=function(grafo=null){
		this.grafo=grafo
	}

	this.getVisNodes=function(){
		return this.vis_nodes
	}

	this.getVisEdges=function(){
		return this.vis_edges
	}


	this.addNode = function(node){
		
		this.vis_nodes.add({id: node.getId(), name: node.getName(), 'color': 'blue' ,'shape': 'circle', 'label': node.getName() , font: {color:'white', face:'sans'}})
	}



	this.addEdge = function(edge){

		
		this.vis_edges.add({id: edge.getId(), from: edge.getNodeI().getId(), to: edge.getNodeF().getId(), label: edge.getValue(), color:"blue", arrows: 'to',  font: {align: 'top'}})
	}



	this.addAll =function(){

		var nodes=this.grafo.getNodes()
		var edges=this.grafo.getEdges()

		//alert("entro a addall nodes{ \nlength: "+nodes.getSize()+"\nnodes: "+nodes.toString()+"\n}")
		for (var i = nodes.getSize() - 1; i >= 0; i--) {
			//alert("introduciendo nodo: "+nodes.getNodeByIndex(i).toString()+"\na Vis")
			this.addNode(nodes.getNodeByIndex(i))
		}

		//alert("entro a addall edges{ \nlength: "+edges.getSize()+"\nnodes: "+edges.toString()+"\n}")
		for (var i = edges.getSize() - 1; i >= 0; i--) {
			//alert("introduciendo arco: "+edge.getEdgeByIndex(i).toString()+"\na Vis")
			this.addEdge(edges.getEdgeByIndex(i))
		}
		//alert("saliendo de addall")

	}


	this.NodeSeleccion= function(node, c){
		this.vis_nodes.update([{id: node.getId(), color:{background:c}}])
		//sys.tweenNode(node, 2, {color:c, radius:4})
	}

	

	this.EdgeSeleccion= function(edge, c){
		//sys.tweenEdge(edge, 0,  { color: c })
		this.vis_edges.update([{id: edge.getId(), arrows: 'to', color:{color:c}}])
	}

	

	this.animationCiega = function (edges, node_sol){
		
		if(this.edge_cont<edges.length){

			this.NodeSeleccion(edges[this.edge_cont].getNodeI(), "red")

			if(node_sol != null && edges[this.edge_cont].getNodeF().getId() == node_sol.getId()){
				this.NodeSeleccion(edges[this.edge_cont].getNodeF(), "green")
				this.EdgeSeleccion(edges[this.edge_cont], "green")
			}else{
				this.NodeSeleccion(edges[this.edge_cont].getNodeF(), "red")
				this.EdgeSeleccion(edges[this.edge_cont], "red")
			}

			this.edge_cont++
			
			
		}else{
			if(!this.fin_animacion){
				if(node_sol!=null){
					this.NodeSeleccion(node_sol, "green")
					alert("EL NODO SOLUCION ES EL: "+node_sol.getName())
				}else{
					alert("NO SE ENCONTRO SOLUCION")
				}
				this.fin_animacion=true
			}	
		}

	}




	this.animationGuiada = function (adys){
		
		if(this.edge_cont<adys.length){


			this.NodeSeleccion(adys[this.edge_cont].getNodoActual(), "green")
			if(adys[this.edge_cont].getNodoPredecesor()!=null){

				this.min_distancia=adys[this.edge_cont].getDistancia()
				this.NodeSeleccion(adys[this.edge_cont].getNodoPredecesor(), "green")
				this.EdgeSeleccion(this.grafo.getEdges().getEdgeByNodes(adys[this.edge_cont].getNodoActual(), adys[this.edge_cont].getNodoPredecesor()), "green")
			}
			
			
			
			this.solucion+=" "+adys[this.edge_cont].getNodoActual().getName()+" -"
			this.edge_cont++
			
			
		}else{
			if(!this.fin_animacion){
				this.solucion+="]"
				alert("La ruta mas corta es : "+this.solucion+"  y la distanica recorrida es : "+this.min_distancia)
				this.fin_animacion=true
			}	
		}

	}

	

}
