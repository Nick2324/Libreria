var camposAniadidos = 0;
var selActual = "seleccion";

function generadorCampos(seleccion){
    var formulario = document.getElementById("form_productos");
    quitarCamposAniadidos(formulario);
    if(seleccion.options[1].selected){
        selActual = "libro";
        preparandoCampos();
        generadorCamposLibro(formulario);
    }else if(seleccion.options[2].selected){
        selActual = "video";
        preparandoCampos();
        generadorCamposVideo(formulario);
    }else{
        selActual = "seleccion";
        preparandoCampos();
    }
}

function generadorCamposLibro(formulario){
    camposAniadidos = 8;
    var label = new Array();
    var campos = new Array();
    camposInput(label,campos);
    campos[0] = crearSelector("genero",["Seleccion","Ciencia","Arte","Literatura"]);
    campos[1].setAttribute("type","text");
    campos[1].setAttribute("name","autor");
    campos[1].setAttribute("placeholder","Autor");
    campos[2].setAttribute("type","text");
    campos[2].setAttribute("name","editorial");
    campos[2].setAttribute("placeholder","Editorial");
    campos[3].setAttribute("type","text");
    campos[3].setAttribute("name","materia");
    campos[3].setAttribute("placeholder","Materia");
    label[0].innerHTML = "Genero";
    label[1].innerHTML = "Autor";
    label[2].innerHTML = "Editorial";
    label[3].innerHTML = "Materia";
    aniadirCampos(formulario,label,campos);
}

function generadorCamposVideo(formulario){
    camposAniadidos = 6;
    var label = new Array();
    var campos = new Array();
    camposInput(label,campos);
    campos[0]=crearSelector("tipo",["Seleccion","Pelicula","Documental"]);
    campos[1].setAttribute("type","text");
    campos[1].setAttribute("name","director");
    campos[1].setAttribute("placeholder","Director");
    campos[2].setAttribute("type","text");
    campos[2].setAttribute("name","productor");
    campos[2].setAttribute("placeholder","Productor");
    label[0].innerHTML = "Tipo";
    label[1].innerHTML = "Director";
    label[2].innerHTML = "Productor";
    aniadirCampos(formulario,label,campos);
}

function preparandoCampos(){
    var seleccionFormato = document.getElementsByName("formato")[0];
    if(selActual == "libro"){
        var nuevoFormato = document.createElement("option");
        nuevoFormato.innerHTML = "Duro";
        nuevoFormato.setAttribute("value","duro");
        seleccionFormato.appendChild(nuevoFormato);
    }else{
        var ultimaOpcion = seleccionFormato.childNodes[seleccionFormato.childNodes.length - 1];
        if(ultimaOpcion.innerHTML == "Duro")
            seleccionFormato.removeChild(ultimaOpcion);
    }
}