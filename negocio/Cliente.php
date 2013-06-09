<?php

namespace Usuarios;

require_once ('TipoUsuario.php');

use Usuarios;

class Cliente extends TipoUsuario{

    private $idCliente;

    function __construct(){}

    function __destruct(){}

    public function getIdCliente(){
        return $this->idCliente;
    }

    public function setIdCliente($idCliente){
        $this->idCliente = $idCliente;
    }

}
?>