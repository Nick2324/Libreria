function cargarEstadoConsultaProductos(){
    var tablaProductos = document.getElementById("productos").tBodies[0];
    var productos = eval(decode(readCookie("productos")));
    var camposTabla = new Array();
    for(var i=0;i<productos.length;i++){
        camposTabla[i] = new Array();
        for(var j=0;j<document.getElementById("productos").tHead.rows[0].cells.length;j++)
            camposTabla[i][j] = document.createElement("th");
    }
    for(var i=0;i<camposTabla.length;i++){
        tablaProductos.appendChild(document.createElement("tr"));
        camposTabla[i][0].innerHTML = productos[i].id;
        camposTabla[i][0].appendChild(crearHidden("id_producto_"+i,productos[i].id));
        camposTabla[i][1].innerHTML = productos[i].nombre;
        camposTabla[i][1].appendChild(crearHidden("nombre_producto_"+i,productos[i].nombre));
        var tipo;
            if(productos[i].genero != null)
                tipo = "Libro";
            else if(productos[i].productor != null)
                tipo = "Video";
        camposTabla[i][2].innerHTML = tipo;
        camposTabla[i][2].appendChild(crearHidden("tipo_producto_"+i,tipo));
        camposTabla[i][3].innerHTML = productos[i].formato;
        camposTabla[i][3].appendChild(crearHidden("formato_producto_"+i,productos[i].formato));
        camposTabla[i][4].innerHTML = productos[i].idioma;
        camposTabla[i][4].appendChild(crearHidden("idioma_producto_"+i,productos[i].idioma));
        camposTabla[i][5].innerHTML = productos[i].transaccionalidad;
        camposTabla[i][5].appendChild(crearHidden("transaccionalidad_producto_"+i,productos[i].transaccionalidad));
        camposTabla[i][6].innerHTML = productos[i].inventarioActivo;
        camposTabla[i][6].appendChild(crearHidden("inventario_producto_"+i,productos[i].inventarioActivo));
        camposTabla[i][7].appendChild(crearBoton(i+"","Modificar","cargaCookiesCambio("+i+",'producto');resolverPeticion('producto','modificar')"));
        camposTabla[i][8].appendChild(crearBoton(""+i,"Cambiar estado","cargaCookiesCambio("+i+",'producto');resolverPeticion('producto','cambiarEstado')"));
        for(var j=0;j<camposTabla[i].length;j++)
            tablaProductos.rows[i].appendChild(camposTabla[i][j]);
    }
}