<?php

namespace Usuarios;

require_once ('Cliente.php');

use Usuarios;

class ClienteAfiliado extends Cliente implements \JsonSerializable{

    private $afiliacionActiva;
    private $fechaAfiliacion;
    private $tipoAfiliacion;

    function __construct(){}

    function __destruct(){}

    public function getAfiliacionActiva(){
        return $this->afiliacionActiva;
    }

    public function getFechaAfiliacion(){
        return $this->fechaAfiliacion;
    }

    public function getTipoAfiliacion(){
        return $this->tipoAfiliacion;
    }

    public function setAfiliacionActiva($afiliacionActiva){
        $this->afiliacionActiva = $afiliacionActiva;
    }

    public function setFechaAfiliacion($fechaAfiliacion){
        $this->fechaAfiliacion = $fechaAfiliacion;
    }
    public function setTipoAfiliacion($tipoAfiliacion){
        $this->tipoAfiliacion = $tipoAfiliacion;
    }

    public function jsonSerialize() {
        return array_merge(Cliente::jsonSerialize(),["afiliacionActiva"=>  $this->afiliacionActiva,
            "fechaAfiliacion"=>$this->fechaAfiliacion,
            "tipoAfiliacion"=>  $this->tipoAfiliacion]);
    }
}
?>