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