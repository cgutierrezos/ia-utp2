function Edge(id, nodei, nodef, value=0){
	this.id=id
	this.nodei=nodei
	this.nodef=nodef
	this.value=value

	this.toString=function(){
		return "from: "+this.nodei.getId()+", to: "+this.nodef.getId()+", value: "+this.getValue()
	}

	this.getValue=function(){
		return this.value
	}

	this.getNodeI=function(){
		return this.nodei
	}

	this.getNodeF=function(){
		return this.nodef
	}

	this.getId=function(){
		return this.id
	}

	this.contains=function(nodei, nodef){
		return this.getNodeI().getName()==nodei.getName() && this.getNodeF().getName()==nodef.getName()
	}
}


function Edges(edges=[]){
	this.edges=edges

	this.addEdge=function(e){
		this.edges.push(e)
	}

	this.getSize=function(){
		return this.edges.length
	}

	this.setEdges=function(edges=[]){
		this.edges=edges
	}

	this.getEdgeByIndex=function(index){
		if(index < this.getSize()){
			return this.edges[index]
		}
		return null
	}


	this.sortByValue=function(){
		var keys=[]
		var edges_sorted=[]
		for (var i = this.getSize() - 1; i >= 0; i--) {
			keys.push(this.edges[i].getValue())
		}

		keys.sort()
		for(key in keys){
			edges_sorted.push(this.edges[key])
		}

		this.setEdges(edges_sorted)

	}


	this.sortById=function(){
		var keys=[]
		var edges_sorted=[]
		for (var i = this.getSize() - 1; i >= 0; i--) {
			keys.push(this.edges[i].getId())
		}

		keys.sort()
		for(key in keys){
			edges_sorted.push(this.edges[key])
		}

		this.setEdges(edges_sorted)

	}


	this.sortByNodeI=function(){
		var keys=[]
		var edges_sorted=[]
		for (var i = this.getSize() - 1; i >= 0; i--) {
			keys.push(this.edges[i].getNodeI())
		}

		keys.sort()
		for(key in keys){
			edges_sorted.push(this.edges[key])
		}

		this.setEdges(edges_sorted)

	}


	this.getEdgeByNodes=function(nodei, nodef){
		if(nodei!=null && nodef!=null){
			for (var i = this.getSize() - 1; i >= 0; i--) {
				if((this.edges[i].getNodeI().getId() == nodei.getId() && this.edges[i].getNodeF().getId() == nodef.getId()) || 
					(this.edges[i].getNodeI().getId() == nodef.getId() && this.edges[i].getNodeF().getId() == nodei.getId())){
					return this.edges[i]
				}
			}
		}

		return null
	}


	this.getEdgesFromNode=function(node){
		if(node!=null){
			var ady_edges=[]
			for (var i = this.getSize() - 1; i >= 0; i--) {
				if(this.edges[i].getNodeI().getId() == node.getId()){
					ady_edges.push(this.edges[i])
				}
			}

			return ady_edges
		}

		return null;

	}

	this.getEdgesToNode=function(node){
		if(node!=null){
			var ady_edges=[]
			for (var i = this.getSize() - 1; i >= 0; i--) {
				if(this.edges[i].getNodeF().getId() == node.getId()){
					ady_edges.push(this.edges[i])
				}
			}

			return ady_edges
		}

		return null;

	}


	this.toString=function(){
		var cadena=""
		for (var i = this.getSize() - 1; i >= 0; i--) {
			cadena+=this.edges[i].toString()+"\n"
		}
		return cadena
	}


}