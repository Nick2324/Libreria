<?php

namespace Transacciones;

require_once ('Cliente.php');
require_once ('Producto.php');

use Usuarios;
use Transacciones;
use Productos;

class Transaccion{
    
    private $id;
    private $vendedor;
    private $cliente;
    private $sucursal;
    private $elementoPago;
    private $tiempo;
    private $productos;
    private $cantidadProductos;
    private $total;
    private $descuento;

    function __construct(){}

    function __destruct(){}

    public function calcularTiempo(){
        $this->tiempo = date("Y-m-d H:i:s");
    }

    public function calcularTotal(){
        if($this->productos != null && $this->cantidadProductos !=null){
            $this->total = 0;
            for($i = 0;$i < count($this->productos);$i++)
                $this->total += $this->productos[$i]->getPrecio()*$this->cantidadProductos[$i];
        }
    }

    public function calcularDescuento(){
        $this->descuento = 0;
    }

    public function getCantidadProductos(){
        return $this->cantidadProductos;
    }

    public function getCliente(){
        return $this->cliente;
    }

    public function getElementoPago(){
        return $this->elementoPago;
    }

    public function getTiempo(){
        return $this->tiempo;
    }

    public function getId(){
        return $this->id;
    }

    public function getProductos(){
        return $this->productos;
    }

    public function getTotal(){
        return $this->total;
    }

    public function getDescuento(){
        return $this->descuento;
    }

    public function getSucursal(){
        return $this->sucursal;
    }
    
    public function getVendedor(){
        return $this->vendedor;
    }
    
    public function setVendedor($vendedor){
        $this->vendedor = $vendedor;
    }

    public function setSucursal($sucursal){
        $this->sucursal = $sucursal;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setCantidadProductos($cantidadProductos){
        $this->cantidadProductos = $cantidadProductos;
    }

    public function setCliente($cliente){
        $this->cliente = $cliente;
    }

    public function setElementoPago($elementoPago){
        $this->elementoPago = $elementoPago;
    }

    public function setProductos($productos){
        $this->productos = $productos;
    }

}
?>