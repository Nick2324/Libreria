function eliminarDatosTransaccion(){
    eliminarDatosCliente();
    eliminarDatosProducto();
    eliminarDatosElementoPago();
}

function eliminarDatosCliente(){
    eraseCookie("cliente");
}

function eliminarDatosProducto(){
    eraseCookie("productos");
    eraseCookie("cantidad");
    eraseCookie("precioTotal");
}

function eliminarDatosElementoPago(){
    eraseCookie("elementoPago");
}