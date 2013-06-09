<?php
namespace Usuarios;

//require_once ('Perfil.php');

//use Perfiles;

class Usuario{

    private $correo;
    private $direccion;
    private $identificacion;
    private $nombre;
    private $tipoUsuarios = array();
    private $telefono;
    private $activo;

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

    public function getNombre(){
        return $this->nombre;
    }

    public function getTelefono(){
        return $this->telefono;
    }
    
    public function getTipoUsuarios(){
        return $this->tipoUsuarios;
    }
    
    public function getActivo(){
        return $this->activo;
    }
    
    public function setActivo($activo){
        $this->activo = $activo;
    }
    
    public function setTipoUsuarios($tipoUsuarios){
        $this->tipoUsuarios = $tipoUsuarios;
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

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

}
?>