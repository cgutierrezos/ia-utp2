function BusquedaCiega(grafo){

    this.grafo=grafo
	this.queue=[]
    this.stack=[]
	this.visited=[]
    this.nodesol=null
    this.arcos_recorridos=[]


    this.getArcosRecorridos=function(){
        return this.arcos_recorridos
    }

    this.getNodoSolucion=function(){
        return this.nodesol
    }


	this.recorridoAnchura = function(nodoi) {

        this.visited[nodoi.getName()] = true

		//Se agrega el nodo a la cola de visitas

        this.queue.push(nodoi)

        var fstack=[]

		//Hasta que visite todos los nodos

        //alert('raiz name: '+this.raiz.name+"  raiz nodes_: "+this.raiz.nodes)

        while (this.queue.length!=0) {

            var nodo = this.queue.shift() //Se saca el primero nodo de la cola

            //alert("nodo name: "+nodo.name+"   node nodes: "+node.nodes)
            //alert("estoy en nodo: "+nodo.name+"   value: "+nodo.value)

            if(fstack.length!=0){
                var nodo_padre=fstack.shift()
                var arco=this.grafo.getEdges().getEdgeByNodes(nodo_padre, nodo)
                this.arcos_recorridos.push(arco)
            }

            if(nodo.getValue()){
                this.nodesol=nodo
            	return 1
            }
            

		//Se busca en la matriz que representa el grafo los nodos adyacentes
            //var arcos_to=this.grafo.getEdges().getEdgesToNode(nodo)
            var h_arcos=this.grafo.getEdges().getEdgesFromNode(nodo)


            //var h_arcos=arcos_from.concat(arcos_to)
            
            for (i = 0; i < h_arcos.length; i++) {

		//Si es un nodo adyacente y no está visitado entonces
                //alert("node: "+nodo.nodes[i].name+"   visited: "+this.visited[nodo.nodes[i].name])
                
                if (!this.visited[h_arcos[i].getNodeF().getName()]) {
                    
                    this.queue.push(h_arcos[i].getNodeF())//Se agrega a la cola de visitas                    

                    this.visited[h_arcos[i].getNodeF().getName()] = true//Se marca como visitado

                    fstack.push(nodo)
                }
            }
        }
        return -1
	}


    this.recorridoProfundidad = function(nodoi) {

        //alert("raiz: "+raiz.name+"   raiz nodes: "+raiz.print()+"   arcos_recorridos: "+arcos_recorridos)

        //agregamos origen a la pila S
        this.stack.push(nodoi)

        var fstack=[]

        //marcamos origen como visitado
        this.visited[nodoi.getName()]=true

        //mientras S no este vacío:
        while(this.stack.length!=0){
      
            //sacamos un elemento de la pila S llamado v
            var nodo=this.stack.pop()

            if(fstack.length!=0){
                var nodo_padre=fstack.pop()
                var arco=this.grafo.getEdges().getEdgeByNodes(nodo_padre, nodo)
                this.arcos_recorridos.push(arco)
            }

            if(nodo.getValue()){
                this.nodesol=nodo
                return 1
            }
            

        //Se busca en la matriz que representa el grafo los nodos adyacentes

            var h_arcos=this.grafo.getEdges().getEdgesFromNode(nodo) 

            for (i = 0; i < h_arcos.length; i++) {

        //Si es un nodo adyacente y no está visitado entonces
                //alert("node: "+nodo.nodes[i].name+"   visited: "+this.visited[nodo.nodes[i].name])
                
                if (!this.visited[h_arcos[i].getNodeF().getName()]) {
                    
                    this.stack.push(h_arcos[i].getNodeF())//Se agrega a la cola de visitas                    

                    this.visited[h_arcos[i].getNodeF().getName()] = true//Se marca como visitado

                    fstack.push(nodo)
                }
            }
   
            //para cada vertice w adyacente a v en el Grafo:
            
        }
        return -1    
    }


	
}