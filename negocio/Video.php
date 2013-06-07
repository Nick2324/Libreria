<?php
namespace Productos;

require_once ('Producto.php');

use Productos;

class Video extends Producto{

    private $idVideo;
    private $director;
    private $productor;
    private $tipo;

    function __construct(){}

    function __destruct(){}

    public function getDirector(){
        return $this->director;
    }

    public function getProductor(){
        return $this->productor;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function getIdVideo(){
        return $this->idVideo;
    }
    
    public function setDirector($director){
        $this->director = $director;
    }

    public function setProductor($productor){
        $this->productor = $productor;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
    }
    
    public function setIdVideo($idVideo){
        $this->idVideo = $idVideo;
    }

}
?>