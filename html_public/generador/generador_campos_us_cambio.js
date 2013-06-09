function generarCamposUsCambio(){
    var usuario = eval("("+decode(readCookie("usuario_cambio"))+")");
    var tablaUsuario = document.getElementById("usuario_cambio").tBodies[0];
    tablaUsuario.rows[1].cells[2].lastChild.setAttribute("value",usuario.identificacion);
    tablaUsuario.rows[1].cells[1].innerHTML = usuario.identificacion;
    tablaUsuario.rows[2].cells[1].innerHTML = usuario.nombre;
    tablaUsuario.rows[3].cells[1].innerHTML = usuario.correo;
    tablaUsuario.rows[4].cells[1].innerHTML = usuario.direccion;
    tablaUsuario.rows[5].cells[1].innerHTML = usuario.telefono;
    tablaUsuario.rows[6].cells[1].innerHTML = usuario.activo;
}