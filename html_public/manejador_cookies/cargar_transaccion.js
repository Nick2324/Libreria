
function cargarEstadoTransaccion(){
    cargarCliente();
    cargarProductos();
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
        valorTabla[0].appendChild(crearHidden("nombre_cliente",cliente.nombre));
        valorTabla[1].innerHTML=cliente.identificacion;
        valorTabla[1].appendChild(crearHidden("identificacion_cliente",cliente.identificacion));
        valorTabla[2].innerHTML=cliente.correoElectronico;
        valorTabla[2].appendChild(crearHidden("correoElectronico_cliente",cliente.correoElectronico));
        valorTabla[3].innerHTML=cliente.telefono;
        valorTabla[3].appendChild(crearHidden("telefono_cliente",cliente.telefono));
        valorTabla[4].innerHTML=cliente.direccion;
        valorTabla[4].appendChild(crearHidden("direccion_cliente",cliente.direccion));
        valorTabla[5].innerHTML=cliente.tipoAfiliacion;
        valorTabla[5].appendChild(crearHidden("tipoAfiliacion_cliente",cliente.tipoAfiliacion));
        for(var i=0;i<tablaCliente.rows.length;i++)
            tablaCliente.rows[i].appendChild(valorTabla[i]);
    }
}

function cargarProductos(){
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
            valorTabla[i][2].innerHTML=productoActual.tipo;
            valorTabla[i][2].appendChild(crearHidden("tipo_producto_"+i,productoActual.tipo));
            valorTabla[i][3].innerHTML=productoActual.transaccionalidad;
            valorTabla[i][3].appendChild(crearHidden("transaccionalidad_producto_"+i,productoActual.transaccionalidad));
            valorTabla[i][4].innerHTML=cantidad[i];
            valorTabla[i][4].appendChild(crearHidden("cantidad_producto_"+i,cantidad[i]));
            valorTabla[i][5].innerHTML=productoActual.precio*cantidad[i];
            valorTabla[i][5].appendChild(crearHidden("precio_total_producto_"+i,productoActual.precio*cantidad[i]));
            valorTabla[i][6].appendChild(crearBoton(i,"Modificar","modificarProducto("+i+")"));
            valorTabla[i][7].appendChild(crearBoton(i,"Eliminar","eliminarProducto("+i+")"));
            for(var j=0;j<valorTabla[i].length;j++)
                tablaProductos.rows[i+1].appendChild(valorTabla[i][j]);
        }
    }
}

function cargarElementoPago(){
    var elementoPago = readCookie("elementoPago");
    var seleccion = document.getElementById("forma_pago");
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