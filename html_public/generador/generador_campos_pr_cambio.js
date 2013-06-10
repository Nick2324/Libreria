function generarCamposPrCambio(){
    var producto_cambio = eval("("+decode(readCookie("producto_cambio"))+")");
    var tablaProducto = document.getElementById("producto_cambio").tBodies[0];
    tablaProducto.rows[1].cells[1].innerHTML = producto_cambio.id;
    document.getElementsByName("id")[0].setAttribute("value",producto_cambio.id);
    tablaProducto.rows[2].cells[1].innerHTML = producto_cambio.nombre;
    tablaProducto.rows[3].cells[1].innerHTML = producto_cambio.descripcion;
    tablaProducto.rows[4].cells[1].innerHTML = producto_cambio.idioma;
    tablaProducto.rows[5].cells[1].innerHTML = producto_cambio.formato;
    tablaProducto.rows[6].cells[1].innerHTML = producto_cambio.transaccionalidad;
    tablaProducto.rows[7].cells[1].innerHTML = producto_cambio.inventarioActivo;
    tablaProducto.rows[8].cells[1].innerHTML = producto_cambio.fechaEdicion;
    tablaProducto.rows[9].cells[1].innerHTML = producto_cambio.stock;
    tablaProducto.rows[10].cells[1].innerHTML = producto_cambio.precio;
    tablaProducto.rows[11].cells[1].innerHTML = producto_cambio.prestado;
    document.getElementsByName("prestado")[0].setAttribute("value",producto_cambio.prestado);
    document.getElementsByTagName("form")[0].appendChild(crearHidden("tipo_producto",producto_cambio.tipoProducto));
    if(producto_cambio.tipoProducto == "video"){
        for(var i=0;i<3;i++){
            tablaProducto.appendChild(document.createElement("tr"));
            for(var j=0;j<3;j++)
                tablaProducto.rows[tablaProducto.rows.length-1].appendChild(document.createElement("th"));
        }
        tablaProducto.rows[12].cells[0].innerHTML = "Tipo";
        tablaProducto.rows[13].cells[0].innerHTML = "Director";
        tablaProducto.rows[14].cells[0].innerHTML = "Productor";
        tablaProducto.rows[12].cells[1].innerHTML = producto_cambio.tipo;
        tablaProducto.rows[13].cells[1].innerHTML = producto_cambio.director;
        tablaProducto.rows[14].cells[1].innerHTML = producto_cambio.productor;
        tablaProducto.rows[12].cells[2].appendChild(crearSelector("tipo",["Seleccion","Pelicula","Documental"]));
        tablaProducto.rows[13].cells[2].appendChild(crearCampoTexto("director"));
        tablaProducto.rows[14].cells[2].appendChild(crearCampoTexto("productor"));
    }else if(producto_cambio.tipoProducto == "libro"){
        for(var i=0;i<4;i++){
            tablaProducto.appendChild(document.createElement("tr"));
            for(var j=0;j<3;j++)
                tablaProducto.rows[tablaProducto.rows.length - 1].appendChild(document.createElement("th"));
        }
        tablaProducto.rows[12].cells[0].innerHTML = "Genero";
        tablaProducto.rows[13].cells[0].innerHTML = "Autor";
        tablaProducto.rows[14].cells[0].innerHTML = "Editorial";
        tablaProducto.rows[15].cells[0].innerHTML = "Materia";
        tablaProducto.rows[12].cells[1].innerHTML = producto_cambio.genero;
        tablaProducto.rows[13].cells[1].innerHTML = producto_cambio.autor;
        tablaProducto.rows[14].cells[1].innerHTML = producto_cambio.editorial;
        tablaProducto.rows[15].cells[1].innerHTML = producto_cambio.materia;
        tablaProducto.rows[12].cells[2].appendChild(crearSelector("genero",["Seleccion","Ciencia","Literatura","Arte"]));
        tablaProducto.rows[13].cells[2].appendChild(crearCampoTexto("autor"));
        tablaProducto.rows[14].cells[2].appendChild(crearCampoTexto("editorial"));
        tablaProducto.rows[15].cells[2].appendChild(crearCampoTexto("materia"));
    }
}