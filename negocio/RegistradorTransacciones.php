<?php

namespace Manejadores;

use Transacciones\Transaccion;
use Usuarios\Cliente;
use Usuarios\ClienteAfiliado;
use Manejadores;

require_once ('Transaccion.php');
require_once ('Manejador.php');
require_once ('ManejadorUsuarios.php');
require_once ('ManejadorProductos.php');

class RegistradorTransacciones extends Manejador{
    
    private $manejadorClientes;
    private $manejadorProductos;

    public function __construct(){
        $this->manejadorClientes = new ManejadorUsuarios;
        $this->manejadorProductos = new ManejadorProductos;
        $this->gatewayTransaccion = new GatewayTransaccion;
        $this->construirManejable();
    }

    function __destruct(){}


    public function construirManejable($partes){
        $this->manejable = new Transaccion;
        $this->manejable->setIdTransaccion($this->construirIdTransaccion());
        $this->manejable->setCliente($this->construirCliente());
        $this->manejable->setProductos($this->construirProductos());
        $this->manejable->setCantidadProductos($this->construirCantidadProductos());
        $this->manejable->setElementoPago($this->construirElementoPago());
        $this->manejable->calcularHoraTransaccion();
        $this->manejable->calcularFechaTransaccion();
        $this->manejable->calcularTotalTransaccion();
    }

    public function registrarTransaccion(){
        echo '<br> registrandoTransaccion..';
    }

    private function construirCliente(){
        return $this->manejadorClientes->buscarCliente((integer)$_POST['identificacion_cliente']);
    }

    private function construirProductos(){
        $productos = array();
        for($i=0;$_POST["id_producto_$i"] != null;$i++)
            $productos[$i] = $this->manejadorProductos->buscarProducto((integer)$_POST["id_producto_$i"]);
        echo print_r($productos);
        return $productos;
    }

    public function construirCantidadProductos(){
        echo '<br> construyendo cantidadProductos..';
        $cantidadProductos = array();
        for($i=0;$_POST["cantidad_producto_$i"] != null;$i++)
            $cantidadProductos[$i] = (integer)$_POST["cantidad_producto_$i"];
        echo print_r($cantidadProductos);
        return $cantidadProductos;
    }
    
    public function construirIdTransaccion(){
        return null;
    }
    
    public function construirElementoPago(){
        return $_POST['elementoPago'];
    }
    
    public function construirManejableCambio($partes){}
    
}
?>