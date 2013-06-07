<?php
namespace Usuarios;

//require_once ('Perfil.php');

//use Perfiles;

class Usuario{

    private $correo;
    private $direccion;
    private $identificacion;
    private $nombre;
    //private $perfil;
    private $telefono;

    function __construct(){}

    function __destruct(){}

    public function getCorreo(){
        return $this->correo;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getIdentificacion(){
        return $this->identificacion;
    }

    public function getManejadores(){}

    public function getNombre(){
        return $this->nombre;
    }

    public function getPerfil(){}

    public function getTelefono(){
        return $this->telefono;
    }

    public function setCorreo($correo){
        $this->correo = $correo;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    public function setIdentificacion($identificacion){
        $this->identificacion = $identificacion;
    }

    public function setManejadores($manejadores){}

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setPerfil($perfil){}

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

}
?>