<?php

namespace Usuarios;

require_once ('Usuario.php');

use Usuarios;

class TipoUsuario implements \JsonSerializable{

    protected $idPerfil;
    protected $nombreUsuario;
    protected $contrasenia;

    function __construct(){}

    function __destruct(){}
    
    public function getIdPerfil(){
        return $this->idPerfil;
    }
    
    public function getNombreUsuario(){
        return $this->nombreUsuario;
    }
    
    public function getContrasenia(){
        return $this->contrasenia;
    }
    
    public function setIdPerfil($id){
        $this->idPerfil = $id;
    }
    
    public function setNombreUsuario($nombreUsuario){
        $this->nombreUsuario = $nombreUsuario;
    }
    
    public function setContrasenia($contrasenia){
        $this->contrasenia = $contrasenia;
    }

    public function jsonSerialize() {
        return ["idPerfil"=>$this->idPerfil,
            "nombreUsuario"=>$this->nombreUsuario,
            "contrasenia"=>  $this->contrasenia];
    }
}

?>
