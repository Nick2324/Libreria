function cargarConsultaUsuarios(){
    var tablaUsuarios = document.getElementById("usuarios").tBodies[0];
    var usuarios = eval(decode(readCookie("usuarios")));
    var camposTabla=new Array();
    for(var i=0;i<usuarios.length;i++){
        camposTabla[i]=new Array();
        for(var j=0;j < document.getElementById("usuarios").tHead.rows[0].cells.length; j++)
            camposTabla[i][j] = document.createElement("th");
    }
    for(var i=0;i<usuarios.length;i++){
        tablaUsuarios.appendChild(document.createElement("tr"));
        camposTabla[i][0].innerHTML = usuarios[i].identificacion;
        camposTabla[i][0].appendChild(crearHidden("identificacion_usuario_"+i,usuarios[i].identificacion));
        camposTabla[i][1].innerHTML = usuarios[i].nombre;
        camposTabla[i][1].appendChild(crearHidden("nombre_usuario_"+i,usuarios[i].nombre));
        camposTabla[i][2].appendChild(crearBoton(i+"","Perfiles",""));
        camposTabla[i][3].appendChild(crearBoton(i+"","Modificar","cargaCookiesCambio("+i+",'usuario');resolverPeticion('usuario','modificar')"));
        camposTabla[i][4].appendChild(crearBoton(i+"","CambiarEstado","cargaCookiesCambio("+i+",'usuario');resolverPeticion('usuario','cambiarEstado')"));
        for(var j=0;j<camposTabla[i].length;j++)
            tablaUsuarios.rows[i].appendChild(camposTabla[i][j]);
    }
}