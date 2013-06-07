var camposAniadidos = 0;

function generarCampos(seleccion){
    var formulario = document.getElementById("form_usuarios");
    quitarCamposAniadidos(formulario);
    if(seleccion.options[1].selected){
        generarCamposCliente(formulario);
    }else if(seleccion.options[2].selected){
        generarCamposClienteAfiliado(formulario);
    }else if(seleccion.options[3].selected){
        generarCamposAdministrador(formulario);
    }else if(seleccion.options[4].selected){
        generarCamposVendedor(formulario);
    }else{
        camposAniadidos = 0;
    }
}

function generarCamposCliente(formulario){
    camposAniadidos = 0;
}

function generarCamposClienteAfiliado(formulario){
    camposAniadidos = 6;
    var label = new Array();
    var campos = new Array();
    camposSelect(label,campos);
    label[0].innerHTML = "Tipo de afiliación";
    label[1].innerHTML = "Estado de afiliación";
    label[2].innerHTML = "Fecha de afiliación";
    campos[0].setAttribute("name","tipo_afiliacion");
    campos[0].innerHTML = "<option value='meses_6'>6 meses</option>"+
            "<option value='meses_12'>Un año</option>";
    campos[1].setAttribute("name","estado_afiliacion");
    campos[1].innerHTML = "<option value='activa'>Activa</option>"+
            "<option value='inactiva'>Inactiva</option>";
    campos[2]=document.createElement("input");
    campos[2].setAttribute("type","date");
    campos[2].setAttribute("name","fecha_afiliacion");
    aniadirCampos(formulario,label,campos);
}

function generarCamposAdministrador(formulario){
    camposAniadidos = 2;
    var label = new Array();
    var campos = new Array();
    camposInput(label,campos);
    label[0].innerHTML = "Nombre de usuario";
    campos[0].setAttribute("type","text");
    campos[0].setAttribute("name","nombre_usuario");
    campos[0].setAttribute("placeholder","Nombre de usuario");
    aniadirCampos(formulario,label,campos);
}

function generarCamposVendedor(formulario){
    camposAniadidos = 2;
    var label = new Array();
    var campos = new Array();
    camposInput(label,campos);
    label[0].innerHTML = "Nombre de usuario";
    campos[0].setAttribute("type","text");
    campos[0].setAttribute("name","nombre_usuario");
    campos[0].setAttribute("placeholder","Nombre de usuario");
    aniadirCampos(formulario,label,campos);
}