function cargarCondonacion(){
    var transaccion = eval(decode("("+readCookie("transaccion")+")"));
    cargarDescripcionTransaccion(transaccion);
    cargarConsultaPrestamos(transaccion.productos);
}

function cargarDescripcionTransaccion(transaccion){
    if(transaccion != null){
        var tablaDescripcion = document.getElementById("descripcion_transaccion").tBodies[0];
        var camposTabla = new Array();
        for(var i=0;i<document.getElementById("descripcion_transaccion").tHead.rows[0].cells.length;i++)
            camposTabla[i] = document.createElement("th");
        tablaDescripcion.appendChild(document.createElement("tr"));
        camposTabla[0].innerHTML = transaccion.id;
        camposTabla[1].innerHTML = transaccion.fecha;
        camposTabla[2].innerHTML = transaccion.cliente.identificacion;
        camposTabla[3].innerHTML = transaccion.cliente.nombre;
        camposTabla[4].innerHTML = transaccion.vendedor;
        camposTabla[0].appendChild(crearHidden("id_transaccion",transaccion.id));
        camposTabla[1].appendChild(crearHidden("fecha_transaccion",transaccion.fecha));
        camposTabla[2].appendChild(crearHidden("cliente.identificacion_transaccion",transaccion.cliente.identificacion));
        camposTabla[3].appendChild(crearHidden("cliente.nombre_transaccion",transaccion.cliente.nombre));
        camposTabla[4].appendChild(crearHidden("vendedor_transaccion",transaccion.vendedor));
        for(var i=0;i<camposTabla.length;i++)
            tablaDescripcion.rows[0].appendChild(camposTabla[i]);
    }
}

function cargarConsultaPrestamos(productos){
    if(productos != null){
        var tablaProductos = document.getElementById("productos_transaccion").tBodies[0];
        var camposTabla = new Array();
        for(var i=0;i<productos.length;i++){
            camposTabla[i]=new Array();
            for(var j=0;j<document.getElementById("productos_transaccion").tHead.rows[0].cells.length;j++)
                camposTabla[i][j] = document.createElement("th");
        }
        for(var i=0;i < camposTabla.length;i++){
            tablaProductos.appendChild(document.createElement("tr"));
            camposTabla[i][0].innerHTML = productos[i].id;
            camposTabla[i][1].innerHTML = productos[i].nombre;
            camposTabla[i][2].innerHTML = productos[i].tipo;
            camposTabla[i][3].innerHTML = productos[i].formato;
            camposTabla[i][4].innerHTML = productos[i].idioma;
            camposTabla[i][0].appendChild(crearHidden("id_producto_"+i,productos[i].id));
            camposTabla[i][1].appendChild(crearHidden("nombre_producto_"+i,productos[i].nombre));
            camposTabla[i][2].appendChild(crearHidden("tipo_producto_"+i,productos[i].tipo));
            camposTabla[i][3].appendChild(crearHidden("formato_producto_"+i,productos[i].formato));
            camposTabla[i][4].appendChild(crearHidden("idioma_producto_"+i,productos[i].idioma));
            camposTabla[i][5].appendChild(crearBoton(i+"","Condonar",""));
            for(var j=0;j<camposTabla[i].length;j++)
                tablaProductos.rows[i].appendChild(camposTabla[i][j]);
        }
    }
}