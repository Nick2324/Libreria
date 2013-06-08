function eliminarProducto(numero){
    if(confirm("¿Seguro que quiere eliminar el producto de la transaccion?")){
        var productos = eval(decode(readCookie("productos")));
        var cantidad = eval(decode(readCookie("cantidad")));
        productos.splice(numero,1);
        cantidad.splice(numero,1);
        createCookie("productos",JSON.stringify(productos),1);
        createCookie("cantidad",JSON.stringify(cantidad),1);
        location.href = "http://localhost/Libreria/html_public/realizar_transacciones/realizar_transaccion.php";
    }
}