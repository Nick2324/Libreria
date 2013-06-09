<?php

namespace Usuarios;

require_once ('TipoUsuario.php');

use Usuarios;

class Vendedor extends TipoUsuario{

    private $idTrabajador;

    function __construct(){}

    function __destruct(){}

    public function getIdTrabajador(){
        return $this->idTrabajador;
    }

    public function setIdTrabajador(int $idTrabajador){
        $this->idTrabajador = $idTrabajador;
    }

}
?>