function camposSelect(label,campos){
    for(var i=0; i<camposAniadidos/2; i++){
        label[i]=document.createElement("p");
        campos[i]=document.createElement("select");
    }
}

function camposInput(label,campos){
    for(var i=0;i<camposAniadidos/2;i++){
        label[i]=document.createElement("p");
        campos[i]=document.createElement("input")
    }
}

function aniadirCampos(formulario,label,campos){
    for(var i=0;i<camposAniadidos;i++){
        formulario.appendChild(label[i]);
        formulario.appendChild(campos[i]);
    }
}

function quitarCamposAniadidos(formulario){
    while(camposAniadidos != 0){
        formulario.removeChild(formulario.childNodes[formulario.childNodes.length - 1]);
        camposAniadidos--;
    }
}