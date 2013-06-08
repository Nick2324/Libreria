<?php

namespace Manejadores;

use Transacciones\Transaccion;
use Usuarios\Usuario;
use Usuarios\Trabajador;
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
    }

    function __destruct(){}


    public function construirManejable($partes){
        $this->manejable = new Transaccion;
        $this->manejable->setIdTransaccion($this->generarId("transaccion"));
        $this->manejable->setCliente($this->construirCliente($partes));
        $this->manejable->setProductos($this->construirProductos($partes));
        $this->manejable->setCantidadProductos($this->construirCantidadProductos($partes));
        $this->manejable->setElementoPago($this->construirElementoPago($partes));
        $this->manejable->calcularHoraTransaccion();
        $this->manejable->calcularFechaTransaccion();
        $this->manejable->calcularTotalTransaccion();
    }

    public function registrarTransaccion(){
        echo '<br> registrandoTransaccion..<br>';
    }

    private function construirCliente($partes){
        echo "<br>Construyendo cliente<br>";
        return null;
    }

    private function construirVendedor($partes){
        echo "<br>Construyendo vendedor<br>";
        return null;
    }
    
    private function construirProductos($partes){
        echo "<br>Construir productos<br>";
        return $productos;
    }

    public function construirCantidadProductos($partes){
        echo "<br>Construir cantidad productos<br>";
        return $cantidadProductos;
    }
    
    public function construirElementoPago($partes){
        echo "<br>Construyendo elemento pago<br>";
        return $partes['elementoPago'];
    }
    
}
?>