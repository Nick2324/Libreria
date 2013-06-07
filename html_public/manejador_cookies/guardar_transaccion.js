function guardarEstadoTransaccion(){
    guardarCliente();
    guardarProductos();
    guardarElementoPago();
}

function guardarCliente(){
    var tablaCliente = document.getElementById("cliente").tBodies[0];
    var arrayCliente = new Array();
    if(tablaCliente.rows[0].cells.length > 1){
        for(var i=0;i<tablaCliente.rows.length;i++)
            arrayCliente[i]=tablaCliente.rows[i].cells[1].lastChild.getAttribute("value");
        var cliente = '{"nombre":"'+arrayCliente[0]+
            '","identificacion":"'+arrayCliente[1]+
            '","correoElectronico":"'+arrayCliente[2]+
            '","direccion":"'+arrayCliente[3]+
            '","telefono":"'+arrayCliente[4]+
            '","tipoAfiliacion":"'+arrayCliente[5]+'"}';
        createCookie("cliente",cliente,1);
    }
}

function guardarProductos(){
    var tablaProductos = document.getElementById("productos").tBodies[0];
    var arrayProductos = new Array();
    if(tablaProductos.rows.length > 1){
        for(var i=0;i<tablaProductos.rows.length-1;i++){
            arrayProductos[i]=new Array();
            for(var j=0;j<tablaProductos.rows[i+1].cells.length - 2;j++){
                arrayProductos[i][j]=tablaProductos.rows[i+1].cells[j].lastChild.getAttribute("value");
            }
        }
        var attr = ["id","nombre","tipo","transaccionalidad"];
        var cantidad = '[';
        var precioTotal = '[';
        var productos = "[";
        for(var i=0; i < arrayProductos.length; i++){
            productos+="{";
            for(var j=0;j < arrayProductos[i].length - 2;j++){
                productos+='"'+attr[j]+'":"'+arrayProductos[i][j]+'"';
                if(j+1<arrayProductos[i].length - 2)
                    productos+=',';
                else
                    productos+='}';
            }
            cantidad+='"'+arrayProductos[i][arrayProductos[i].length - 2]+'"';
            precioTotal+='"'+arrayProductos[i][arrayProductos[i].length - 1]+'"';
            if(i + 1 < arrayProductos.length){
                productos+=',';
                cantidad+=',';
                precioTotal+=',';
            }else{
                productos+=']';
                cantidad+=']';
                precioTotal+=']';
            }
        }
        createCookie("productos",productos,1);
        createCookie("cantidad",cantidad,1);
        createCookie("precioTotal",precioTotal,1);
    }
}

function guardarElementoPago(){
    var seleccion = document.getElementById("forma_pago");
    for(var i=0;i<seleccion.options.length;i++)
        if(seleccion.options[i].selected){
            createCookie("elementoPago",seleccion.options[i].innerHTML,1);
            break;
        }
}