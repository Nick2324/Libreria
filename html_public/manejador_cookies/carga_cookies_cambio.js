function cargaCookiesCambio(numero,tipoCookie){
    var cookie, nombreObjeto;
    if(tipoCookie == 'producto')
        nombreObjeto = 'productos';
    else if(tipoCookie == 'usuario')
        nombreObjeto = 'usuarios';
    var arrayObjeto = eval(decode(readCookie(nombreObjeto)));
    cookie = JSON.stringify(arrayObjeto[numero]);
    createCookie(tipoCookie+"_cambio",cookie,1);
}

function resolverPeticion(tipoCookie,accion){
    if(tipoCookie == "producto"){
        if(accion == "modificar"){
            location.href = "http://localhost/Libreria/html_public/productos/modificar_producto.php";
        }else if(accion == "cambiarEstado"){
            location.href = "http://localhost/Libreria/html_public/productos/cambiar_estado_producto.php";
        }
    }else if(tipoCookie == "usuario"){
        if(accion == "modificar"){
            location.href = "http://localhost/Libreria/html_public/usuarios/modificar_usuario.php";
        }else if(accion == "cambiarEstado"){
            location.href = "http://localhost/Libreria/html_public/usuarios/cambiar_estado_usuario.php";
        }
    }
}

function eliminarElementoCambio(tipoCookie){
    eraseCookie(tipoCookie+"_cambio");
}

function cargarElementoCambio(tipoCookie){
    var id, estado;
    var objeto = eval("("+decode(readCookie(tipoCookie+"_cambio"))+")");
    if(tipoCookie == "producto"){
        var id = document.getElementsByName("id")[0];
        var estado = document.getElementsByName("inventario")[0];
        id.setAttribute("value",objeto.id);
        estado.setAttribute("value",objeto.inventarioActivo);
    }else if(tipoCookie == "usuario"){
        var id = document.getElementsByName("identificacion")[0];
        var estado = document.getElementsByName("activo")[0];
        id.setAttribute("value",objeto.identificacion);
        estado.setAttribute("value",objeto.activo);
    }
}