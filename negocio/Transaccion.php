<?php

namespace Transacciones;

require_once ('Cliente.php');
require_once ('Producto.php');

use Usuarios;
use Transacciones;
use Productos;

class Transaccion{

	private $cantidadProductos;
	private $cliente;
	private $elementoPago;
	private $fechaTransaccion;
	private $horaTransaccion;
	private $idTransaccion;
	private $productos;
	private $totalTransaccion;

	function __construct(){}

	function __destruct(){}



	public function calcularHoraTransaccion(){
            $this->horaTransaccion = date("H:i:s");
	}

	public function calcularFechaTransaccion(){
            $this->fechaTransaccion = date("Y/m/d");
	}

	public function calcularTotalTransaccion(){
            if($this->productos != null && $this->cantidadProductos !=null){
                $this->totalTransaccion = 0;
                for($i = 0;$i < count($productos);$i++)
                    $totalTransaccion += $productos[$i]->getPrecio()*$this->cantidadProductos[$i];
            }
	}

	public function getCantidadProductos(){
            return $this->cantidadProductos();
	}

	public function getCliente(){
            return $this->cliente;
	}

	public function getElementoPago(){
            return $this->elementoPago;
	}

	public function getFechaTransaccion(){
            return $this->fechaTransaccion;
	}

	public function getHoraTransaccion(){
            return $this->horaTransaccion;
	}

	public function getIdTransaccion(){
            return $this->idTransaccion;
	}

	public function getProductos(){
            return $this->productos;
	}

	public function getTotalTransaccion(){
            return $this->totalTransaccion;
	}

        public function setIdTransaccion($idTransaccion){
            $this->idTransaccion = $idTransaccion;
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