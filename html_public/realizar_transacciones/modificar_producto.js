function modificarProducto(numero){
    var cantidadNueva = parseInt(prompt("Ingrese la cantidad de producto que se quiere"));
    var productos = eval(decode(readCookie("productos")));
    var diferencia;
    if(productos[numero].transaccionalidad == "Prestamo")
        diferencia = productos[numero].stock - productos[numero].prestado;
    else if(productos[numero].transaccionalidad == "Venta")
        diferencia = productos[numero].stock;
    if(cantidadNueva > 0 && cantidadNueva <= diferencia){
        var cantidad = eval(decode(readCookie("cantidad")));
        cantidad[numero] = cantidadNueva;
        createCookie("cantidad",JSON.stringify(cantidad),1);
        location.href = "http://localhost/Libreria/html_public/realizar_transacciones/realizar_transaccion.php";
    }else
        alert("Valor ingresado no valido. Puede que exceda\n\
                el total en inventario");
}