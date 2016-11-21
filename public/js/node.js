function Node(id, name, value=false){
	this.value=false
	this.name=name
	this.id=id
	

	this.setValue= function(value){
		this.value=value
	}

	this.setName=function(name){
		this.name=name
	}

	this.setId=function(id){
		this.id=id
	}


	this.getValue=function(){
		return this.value
	}

	this.getId=function(){
		return this.id
	}

	this.getName=function(){
		return this.name
	}

	this.toString= function(){
        return "id: "+this.id+",   name: "+this.name+",  value: "+this.value
	}
}


function Nodes(nodes=[]){
	this.nodes=nodes

	this.getNodes=function(){
		return nodes
	}


	this.getSize=function(){
		return nodes.length
	}

	this.addNode=function(node){
		this.nodes.push(node)
	}

	this.setNodes=function(nodes=[]){
		this.nodes=nodes
	}

	this.getNodeById=function(id){
		for (var i = this.getSize() - 1; i >= 0; i--) {
			var node=this.nodes[i]
			if(node.getId()== id){
				return node
			}
		}

		return null
	}

	this.getNodeByName=function(name){
		for (var i = this.getSize() - 1; i >= 0; i--) {
			var node=this.nodes[i]
			if(node.getName()== name){
				return node
			}
		}

		return null
	}

	this.getNodeByIndex=function(index){
		if(index < this.getSize()){
			return this.nodes[index]
		}
		return null
	}


	this.toString=function(){
		var cadena=""

		for (var i = this.getSize() - 1; i >= 0; i--) {
			cadena+=this.nodes[i].toString()+"\n"
		}

		return cadena
	}
}