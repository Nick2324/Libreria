<?php

namespace Usuarios;

require_once ('TipoUsuario.php');

use Usuarios;

class Cliente extends TipoUsuario implements \JsonSerializable{

    protected $idCliente;

    function __construct(){}

    function __destruct(){}

    public function getIdCliente(){
        return $this->idCliente;
    }

    public function setIdCliente($idCliente){
        $this->idCliente = $idCliente;
    }
    
    public function jsonSerialize() {
        return array_merge(TipoUsuario::jsonSerialize(),["idCliente"=>$this->idCliente]);
    }

}
?>