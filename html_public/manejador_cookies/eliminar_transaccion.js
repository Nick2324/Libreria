function eliminarDatosTransaccion(){
    eliminarDatosCliente();
    eliminarDatosProducto();
    eliminarDatosElementoPago();
    eliminarDatosSucursal();
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

function eliminarDatosSucursal(){
    eraseCookie("sucursal");
}