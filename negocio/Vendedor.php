<?php

namespace Usuarios;

require_once ('TipoUsuario.php');

use Usuarios;

class Vendedor extends TipoUsuario{

    private $idVendedor;

    function __construct(){}

    function __destruct(){}

    public function getIdVendedor(){
        return $this->idVendedor;
    }

    public function setIdVendedor($idVendedor){
        $this->idVendedor = $idVendedor;
    }

}
?>