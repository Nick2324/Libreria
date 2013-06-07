function guardarEstadoConsultaUsuarios(){
    alert("guardando ...");
    var tablaUsuarios = document.getElementById("usuarios").tBodies[0];
    var arrayUsuarios = new Array();
    var usuarios = "[";
    var attr = ["identificacion","nombre"];
    for(var i=0;i<tablaUsuarios.rows.length;i++){
        arrayUsuarios[i] = new Array();
        for(var j=0;j<tablaUsuarios.rows[i].cells.length - 3;j++)
            arrayUsuarios[i][j] = tablaUsuarios.rows[i].cells[j].lastChild.getAttribute("value");
    }
    for(var i=0;i<arrayUsuarios.length;i++){
        usuarios += "{";
        for(var j=0;j<arrayUsuarios[i].length;j++){
            usuarios += '"'+attr[j]+'":"'+arrayUsuarios[i][j]+'"';
            if(j + 1 != arrayUsuarios[i].length)
                usuarios += ",";
            else
                usuarios += "}";
        }
        if(i + 1 != arrayUsuarios.length)
            usuarios += ","
        else
            usuarios += "]";
    }
    createCookie("usuarios",usuarios,1);
    alert(document.cookie);
}


