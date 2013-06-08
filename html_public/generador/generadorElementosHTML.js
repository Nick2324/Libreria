function crearBoton(nombre,valor,evento){
    var boton = document.createElement("input");
    boton.setAttribute("type","button");
    boton.setAttribute("name",nombre);
    boton.setAttribute("value",valor);
    boton.setAttribute("onclick",evento);
    return boton;
}

function crearHidden(nombre,valor){
    var hidden = document.createElement("input");
    hidden.setAttribute("type","hidden");
    hidden.setAttribute("name",nombre);
    hidden.setAttribute("value",valor);
    return hidden;
}

function crearSelector(nombre,valorOpciones){
    var selector = document.createElement("select");
    try{
    selector.setAttribute("name",nombre); 
    var opciones = new Array();
    for(var i=0;i<valorOpciones.length;i++){
        opciones[i] = document.createElement("option");
        opciones[i].innerHTML = valorOpciones[i];
        opciones[i].setAttribute("value",valorOpciones[i]);
        selector.appendChild(opciones[i]);
        
    }
    }catch(err){alert(err);}
    return selector;
}

function crearCampoTexto(nombre){
    var campoTexto = document.createElement("input");
    campoTexto.setAttribute("type","text");
    campoTexto.setAttribute("name",nombre);
    return campoTexto;
}