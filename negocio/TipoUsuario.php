<?php

namespace Usuarios;

require_once ('Usuario.php');

use Usuarios;

class TipoUsuario{

    private $id;
    private $nombreUsuario;
    private $contrasenia;

    function __construct(){}

    function __destruct(){}
    
    public function getId(){
        return $this->id;
    }
    
    public function getNombreUsuario(){
        return $this->nombreUsuario;
    }
    
    public function getContrasenia(){
        return $this->contrasenia;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setNombreUsuario($nombreUsuario){
        $this->nombreUsuario = $nombreUsuario;
    }
    
    public function setContrasenia($contrasenia){
        $this->contrasenia = $contrasenia;
    }
}

?>
