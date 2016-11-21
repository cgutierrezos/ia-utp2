



function BusquedaGuiada(grafo){

	this.grafo=grafo
    this.dijkstra=new Dijkstra()


    

    this.getDijkstra=function(){
        return this.dijkstra
    }

	this.recorridoRutaCorta = function(nodoi, nodof) {
        
        //inicialiso el adyacente con el nodo inicial: distancia=0, nodo_predecesor=null, nodo_actual=nodoi, iteracion=0
        var ady_permanente=new Adyacente(0, null, nodoi, 0)

        //agrego en los candidatos a ady_permanente
        this.dijkstra.addAdy(ady_permanente)

        //los ordeno de menor a mayor 
        this.dijkstra.sort()

        //selecciono un nuevo ady_permanente que sera el menor de la lista de candidatos
        ady_permanente=this.dijkstra.getMenor()
        


        //mientras no sea ady_permanente el nodof es decir el nodo final
        while(!this.dijkstra.isTarget(ady_permanente.getNodoActual().getName(), nodof.getName())){
      
            //agrego candidatos que parten del nodo actual del ady_permanente
            this.dijkstra.addCandidatos(this.grafo, ady_permanente)
            

            //los ordeno de menor a mayor 
            this.dijkstra.sort()

            //selecciono un nuevo ady_permanente que sera el menor de la lista de candidatos
            ady_permanente=this.dijkstra.getMenor()
            


        }

        return -1    
    }


}


function Dijkstra(){
    this.adys_cantidatos=[]
    this.adys_etiquetados=[]
    this.adys_ruta=[]

    this.getRuta=function(){
        var oldadys=this.adys_etiquetados
        var newadys=[]
        var ady=oldadys.pop()
        while(ady.getNodoPredecesor()!=null){
            newadys.push(ady)
            for (var i = oldadys.length - 1; i >= 0; i--) {
                if(oldadys[i].getNodoActual().getName() == ady.getNodoPredecesor().getName()){
                    ady=oldadys[i]
                    i=-1
                }
            }
        }

        newadys.push(ady)

        newadys.reverse()

        return newadys
    }

    this.candidatosToString=function(){
        var cadena=""
        for (var i = this.adys_cantidatos.length - 1; i >= 0; i--) {
            cadena+=this.adys_cantidatos[i].toString()+"\n"
        }
        return cadena
    }

    this.etiquetadosToString=function(){
        var cadena=""
        for (var i = this.adys_etiquetados.length - 1; i >= 0; i--) {
            cadena+=this.adys_etiquetados[i].toString()+"\n"
        }
        return cadena
    }

    this.getAdysEtiquetados=function(){
        return this.adys_etiquetados
    }


    this.getSize=function(){
        return this.adys.length
    }

    this.isTarget=function(ady_name, nodo_name){
        return ady_name == nodo_name
        
    }

    this.addAdy=function(ady){
        for (var i = this.adys_etiquetados.length - 1; i >= 0; i--) {
            if(this.adys_etiquetados[i].equalsTo(ady)){
                return -1
            }
        }

        for (var i = this.adys_cantidatos.length - 1; i >= 0; i--) {
            if(this.adys_cantidatos[i].equalsTo(ady)){
                if(ady.getDistancia() < this.adys_cantidatos[i].getDistancia()){
                    this.adys_cantidatos[i]=ady
                    return -1
                }
            }
        }

        this.adys_cantidatos.push(ady)
        return -1
    }

    this.addAdys=function(adys){
        for (var i = adys.length - 1; i >= 0; i--) {
            this.addAdy(adys[i])
        }
    }

    this.edgesToAdys=function(grafo, distancia, edges, iteracion){
        var adys=[]
        for (var i = edges.getSize() - 1; i >= 0; i--) {            
            var edge=grafo.getEdges().getEdgeByNodes(edges.getEdgeByIndex(i).getNodeI(), edges.getEdgeByIndex(i).getNodeF())            

            adys.push(new Adyacente(distancia+edge.getValue(), edge.getNodeI(), edge.getNodeF(), iteracion+1))
        }
        return adys
    }


    this.sort = function(){
        this.adys_cantidatos.sort(function (a, b){
            return (b.distancia - a.distancia)
        })
    }

    this.getMenor = function(){
        var menor=this.adys_cantidatos.pop()
        this.adys_etiquetados.push(menor)
        return menor
    }




    this.addCandidatos=function(grafo, ady){
        

        var fromnode=grafo.getEdges().getEdgesFromNode(ady.getNodoActual())
        //var tonode=grafo.getEdges().getEdgesToNode(ady.getNodoActual())

        

        var edges_candidatos=new Edges(fromnode)
        
        
        var adys_cantidatos=this.edgesToAdys(grafo, ady.getDistancia() , edges_candidatos, ady.getIteracion())
        

        this.addAdys(adys_cantidatos)

    }




}

function Adyacente(d, nodoi, nodof, i){
    this.distancia=d
    this.nodoi=nodoi
    this.nodof=nodof
    this.iteracion=i
    

    this.setConfig=function(d, nodoi, nodof, i){
        this.distancia=d
        this.nodoi=nodoi
        this.nodof=nodof
        this.iteracion=i
    }

    this.getDistancia=function(){
        return this.distancia
    }

    this.getNodoPredecesor=function(){
        return this.nodoi
    }

    this.getNodoActual=function(){
        return this.nodof
    }

    this.getIteracion=function(){
        return this.iteracion
    }

    this.equalsTo=function(ady){
        return  ady.getNodoActual() == this.getNodoActual()
    }

    this.toString=function(){
        var cadena="[ "
        if(this.getNodoPredecesor()!=null){
            cadena+=this.getNodoPredecesor().getName()
        }else{
            cadena+="-"
        }
        cadena+=" , "

        if(this.getNodoActual()!=null){
            cadena+=this.getNodoActual().getName()
        }else{
            cadena+="-"
        }
        cadena+=" ]"
        cadena+="( "+this.getDistancia()+" )"

        return cadena
    }

    
}


