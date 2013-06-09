<?php

namespace Prestamo;

class Prestamo{
    
    private $idCliente;
    private $idProducto;
    private $idTransaccion;
    private $moroso;
    private $prestado;
    
    function __construct(){}

    function __destruct(){}
    
    public function getPrestado(){
        return $this->prestado;
    }
    
    public function getMoroso(){
        return $this->moroso;
    }
    
    public function getIdCliente(){
        return $this->idCliente;
    }
    
    public function getIdProducto(){
        return $this->idProducto;
    }
    
    public function getIdTransaccion(){
        return $this->idTransaccion;
    }
    
    public function setPrestado($prestado){
        $this->prestado = $prestado;
    }
    
    public function setMoroso($moroso){
        $this->moroso = $moroso;
    }
    
    public function setIdCliente($cliente){
        $this->idCliente = $cliente;
    }
    
    public function setIdProducto($producto){
        $this->idProducto = $producto;
    }
    
    public function setIdTransaccion($transaccion){
        $this->idTransaccion = $transaccion;
    }
}

?>
