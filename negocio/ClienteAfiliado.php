<?php

namespace Usuarios;

require_once ('Cliente.php');

use Usuarios;

class ClienteAfiliado extends Cliente{

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
    public function setTipoAfiliacion(int $tipoAfiliacion){
        $this->tipoAfiliacion = $tipoAfiliacion;
    }

}
?>