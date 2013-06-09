<?php

namespace Usuarios;

require_once ('TipoUsuario.php');

use Usuarios;

class Vendedor extends TipoUsuario implements \JsonSerializable{

    private $idVendedor;

    function __construct(){}

    function __destruct(){}

    public function getIdVendedor(){
        return $this->idVendedor;
    }

    public function setIdVendedor($idVendedor){
        $this->idVendedor = $idVendedor;
    }

    public function jsonSerialize() {
        return array_merge(TipoUsuario::jsonSerialize(),["idVendedor"=>$this->idVendedor]);
    }
}
?>