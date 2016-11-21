function Grafo(nodes=null, edges=null) {
	this.nodes=nodes
	this.edges=edges
	
	this.getNodes=function(){
		return this.nodes
	}

	this.getEdges=function(){
		return this.edges
	}

	this.addNode=function(node){
		if(this.nodes==null){
			this.nodes=new Nodes()
		}
		
		this.nodes.addNode(node)
	}


	this.addEdge=function(edge){
		if(this.edges==null){
			this.edges=new Edges()
		}

		this.edges.addEdge(edge)
	}

	this.getNodeById=function(id){
		return this.nodes.getNodeById(id)
	}

	this.getNodeByName=function(name){
		return this.nodes.getNodeByName(name)
	}

	this.getEdgesFromNode=function(node){
		return this.edges.getEdgesFromNode(node)
	}

	this.resetConfig=function(){
		if(this.edges==null){
			this.edges=new Edges()
		}else{
			this.edges.setEdges()
		}

		if(this.nodes==null){
			this.nodes=new Nodes()
		}else{
			this.nodes.setNodes()
		}
	}

	this.random = function(min, max){
		return min+Math.floor(Math.random()*(max-min+1))
	}


	this.generateRandomGrafo=function(){

		this.resetConfig()

		var edge_cont=0
		var node_cont=0
		var max_nodos=this.random(40, 80)
		var min_nodos=this.random(5,19)
		var maxprof=this.random(6, 10)
		var prof=0
		var rand=this.random(-1, maxprof-1)
		var hijos=this.random(1, 4)
		
		var queue=[]

		var nodo=new Node(node_cont,"RAIZ")
		
		if(rand==0){
			nodo.setValue(true)
		}

		this.addNode(nodo)
		node_cont++

		queue.push(nodo)


        do {

			var tesoro=-1

			
			if(rand==prof){
				tesoro=this.random(0, hijos-1)
			}

			


            var nodoi = queue.shift() //Se saca el primero nodo de la cola
            
            

            for (i = 0; i < hijos; i++) {

			

                

				var nodof=new Node(node_cont, node_cont+"")
				if(tesoro==i)
					nodof.setValue(true)

				this.addEdge(new Edge(edge_cont, nodoi, nodof))
				edge_cont++

				this.addNode(nodof)
				node_cont++

				queue.push(nodof)

				

            }

            prof+=1
            hijos=this.random(0, 4)
	        

        }while (queue.length!=0 && node_cont<max_nodos && prof<maxprof)
	}


	this.generateSavedGrafo = function(nodes, edges) {

		this.resetConfig()


		for (var i = nodes.length - 1; i >= 0; i--){
			this.addNode(new Node(nodes[i].id, nodes[i].name, nodes[i].value))
		} 
			

		for (var i = edges.length - 1; i >= 0; i--) {
			this.addEdge(new Edge(edges[i].id, this.nodes.getNodeById(edges[i].nodei_id), this.nodes.getNodeById(edges[i].nodef_id), edges[i].value))
			
		}

	}


	this.toString=function(){

		var cadena="nodes: \n"
		cadena+=this.nodes.toString()+"\n\n"

		cadena+="edges: \n"
		cadena+=this.edges.toString()

		return cadena

	}
}