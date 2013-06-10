
function cargarEstadoTransaccion(){
    cargarCliente();
    cargarProductos(calcularDescuento());
    cargarElementoPago();
    cargarSucursal();
}

function cargarCliente(){
    var cliente = eval(decode("("+readCookie("cliente")+")"));
    if(cliente!=null){
        var tablaCliente=document.getElementById("cliente").tBodies[0];
        var valorTabla=new Array();
        for(var i=0;i<tablaCliente.rows.length; i++)
            valorTabla[i] = document.createElement("th");
        valorTabla[0].innerHTML=cliente.nombre;
        valorTabla[0].appendChild(crearHidden("nombre",cliente.nombre));
        valorTabla[1].innerHTML=cliente.identificacion;
        valorTabla[1].appendChild(crearHidden("identificacion",cliente.identificacion));
        valorTabla[2].innerHTML=cliente.correo;
        valorTabla[2].appendChild(crearHidden("correoElectronico",cliente.correo));
        valorTabla[3].innerHTML=cliente.telefono;
        valorTabla[3].appendChild(crearHidden("telefono",cliente.telefono));
        valorTabla[4].innerHTML=cliente.direccion;
        valorTabla[4].appendChild(crearHidden("direccion",cliente.direccion));
        valorTabla[5].innerHTML=cliente.tipoUsuarios[1].tipoAfiliacion;
        valorTabla[5].appendChild(crearHidden("tipoAfiliacion",cliente.tipoUsuarios[1].tipoAfiliacion));
        for(var i=0;i<tablaCliente.rows.length;i++)
            tablaCliente.rows[i].appendChild(valorTabla[i]);
    }
}

function cargarProductos(descuento){
    var productos=eval(decode(readCookie("productos")));
    if(productos!=null){
        var tablaProductos=document.getElementById("productos").tBodies[0];
        var cantidad=eval(decode(readCookie("cantidad")));
        var valorTabla=new Array();
        var productoActual;
        for(var i=0;i<productos.length;i++){
            valorTabla[i]=new Array();
            for(var j=0;j<tablaProductos.rows[0].cells.length;j++)
            valorTabla[i][j]=document.createElement("th");
        }
        for(var i=0;i<productos.length;i++){
            productoActual = productos[i];
            tablaProductos.appendChild(document.createElement("tr"));
            valorTabla[i][0].innerHTML=productoActual.id;
            valorTabla[i][0].appendChild(crearHidden("id_producto_"+i,productoActual.id));
            valorTabla[i][1].innerHTML=productoActual.nombre;
            valorTabla[i][1].appendChild(crearHidden("nombre_producto_"+i,productoActual.nombre));
            var tipo;
            if(productoActual.genero != null)
                tipo = "Libro";
            else if(productoActual.productor != null)
                tipo = "Video";
            valorTabla[i][2].innerHTML = tipo;
            valorTabla[i][2].appendChild(crearHidden("tipo_producto_"+i,tipo));
            valorTabla[i][3].innerHTML=productoActual.transaccionalidad;
            valorTabla[i][3].appendChild(crearHidden("transaccionalidad_producto_"+i,productoActual.transaccionalidad));
            valorTabla[i][4].innerHTML=cantidad[i];
            valorTabla[i][4].appendChild(crearHidden("cantidad_producto_"+i,cantidad[i]));
            valorTabla[i][5].innerHTML=productoActual.precio*cantidad[i]*descuento;
            valorTabla[i][6].appendChild(crearBoton(i,"Modificar","modificarProducto("+i+")"));
            valorTabla[i][7].appendChild(crearBoton(i,"Eliminar","eliminarProducto("+i+")"));
            for(var j=0;j<valorTabla[i].length;j++)
                tablaProductos.rows[i+1].appendChild(valorTabla[i][j]);
        }
        tablaProductos.appendChild(document.createElement("tr"));
        tablaProductos.rows[tablaProductos.rows.length-1].appendChild(document.createElement("th"));
        tablaProductos.rows[tablaProductos.rows.length-1].appendChild(document.createElement("th"));
        tablaProductos.rows[tablaProductos.rows.length-1].childNodes[0].innerHTML = "Total";
        tablaProductos.rows[tablaProductos.rows.length-1].childNodes[1].innerHTML = calcularTotal(productos,cantidad,descuento);
    }
}

function cargarElementoPago(){
    var elementoPago = readCookie("elementoPago");
    var seleccion = document.getElementById("elemento_pago");
    for(var i = 0;i < seleccion.options.length; i++)
        if(seleccion.options[i].getAttribute("value") == elementoPago){
            seleccion.options[i].selected = true;
            break;
        }
}

function cargarSucursal(){
    var sucursal = readCookie("sucursal");
    var seleccion = document.getElementsByName("sucursal")[0];
    for(var i=0;i<seleccion.options.length;i++)
        if(seleccion.options[i].getAttribute("value") == sucursal){
            seleccion.options[i].selected = true;
            break;
        }
}

function calcularDescuento(){
    var cliente = eval("("+decode(readCookie("cliente"))+")");
    return (cliente.tipoUsuarios[1].tipoAfiliacion != null ? (
        cliente.tipoUsuarios[1].tipoAfiliacion == 1 ? 0.8 : 0.7) : 1);
}

function calcularTotal(productos,cantidad,descuento){
    var total = 0;
    for(var i=0;i<productos.length;i++)
        total += productos[i].precio*cantidad[i]*descuento;
    return total;
}