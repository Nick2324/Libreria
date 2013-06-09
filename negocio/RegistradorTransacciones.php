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
require_once ('ManejadorPrestamos.php');

class RegistradorTransacciones extends Manejador{
    
    private $manejadorUsuarios;
    private $manejadorProductos;
    private $manejadorPrestamos;

    public function __construct(){
        $this->manejadorUsuarios = new ManejadorUsuarios;
        $this->manejadorProductos = new ManejadorProductos;
        $this->manejadorPrestamos = new ManejadorPrestamos;
    }

    function __destruct(){}


    public function construirManejable($partes){
        $this->manejable = new Transaccion;
        $this->manejable->setId($this->generarId("transaccion"));
        $this->manejable->setCliente($this->construirCliente($partes));
        $this->manejable->setVendedor($this->construirVendedor($partes));
        $this->manejable->setProductos($this->construirProductos($partes));
        $this->manejable->setCantidadProductos($this->construirCantidadProductos($partes));
        $this->manejable->setElementoPago($this->construirElementoPago($partes));
        $this->manejable->setSucursal($this->obtenerIdSucursal($partes['sucursal']));
        $this->manejable->calcularDescuento();
        $this->manejable->calcularTiempo();
        $this->manejable->calcularTotal();
    }

    public function registrarTransaccion(){
        $resultado = $this->insert("transaccion", $this->generarAVTransaccion());
        for($i=0;$i<count($this->manejable->getProductos()) && $resultado;$i++){
            $resultado = $this->insert("transaccion_producto", $this->generarAVTransaccionProductos($i));
            $partes = null;
            if($this->manejable->getProductos()[$i]->getTransaccionalidad()=="Venta"){
                $stock = $this->manejable->getProductos()[$i]->getStock() - $this->manejable->getCantidadProductos()[$i];
                $partes = array("id"=>$this->manejable->getProductos()[$i]->getId(),
                    "stock"=>$stock);
            }else if($this->manejable->getProductos()[$i]->getTransaccionalidad()=="Prestamo"){
                $prestado = $this->manejable->getCantidadProductos()[$i] + $this->manejable->getProductos()[$i]->getPrestado();
                $partes = array("id"=>$this->manejable->getProductos()[$i]->getId(),
                    "prestado"=>$prestado);
                $this->manejadorPrestamos->construirManejable(array("id_cliente"=>$this->manejable->getCliente()->getTipoUsuarios()[1]->getIdCliente(),
                    "id_transaccion"=>$this->manejable->getId(),
                    "id_producto"=>$this->manejable->getProductos()[$i]->getId(),
                    "prestado"=>$this->manejable->getCantidadProductos()[$i]));
                $this->manejadorPrestamos->adicionarPrestamo();
            }
            $this->manejadorProductos->construirManejable($partes);
            $resultado = $this->manejadorProductos->actualizarProducto();
        }
        return $resultado;
    }

    private function construirCliente($partes){
        $this->manejadorUsuarios->construirManejable(array("identificacion"=>$partes['identificacion']));
        return $this->manejadorUsuarios->buscarUsuario()[0];
    }

    private function construirVendedor($partes){
        $this->manejadorUsuarios->construirManejable(array("identificacion"=>1));
        return $this->manejadorUsuarios->buscarUsuario()[0];
    }
    
    private function construirProductos($partes){
        $i=0;
        $productos = array();
        do{
            $id = $partes['id_producto_'."$i"];
            if($id != null){
                $this->manejadorProductos->construirManejable(["id" => $id]);
                $productos[$i++]=$this->manejadorProductos->buscarProducto()[0];
            }
        }while($id != null);
        return $productos;
    }

    public function construirCantidadProductos($partes){
        $i=0;
        $arrayCantidad = array();
        do{
            $cantidad = $partes['cantidad_producto_'."$i"];
            if($cantidad != null)
                $arrayCantidad[$i++] = $cantidad;
        }while($cantidad != null);
        return $arrayCantidad;
    }
    
    public function construirElementoPago($partes){
        return $partes['elemento_pago'];
    }
    
    private function generarAVTransaccion(){
        $av = array();
        $av[0]=array(0=>"`k_id_transaccion`",
            1=>"`k_id_sucursal`",
            2=>"`k_id_cliente`",
            3=>"`k_id_vendedor`",
            4=>"`n_elemento_pago`",
            5=>"`dt_transaccion`",
            6=>"`v_total_transaccion`",
            7=>"`v_descuento`");
        $av[1]=array(0=>$this->manejable->getId(),
            1=>$this->manejable->getSucursal(),
            2=>$this->manejable->getCliente()->getTipoUsuarios()[1]->getIdCliente(),
            3=>$this->manejable->getVendedor()->getTipoUsuarios()[0]->getIdVendedor(),
            4=>$this->manejable->getElementoPago(),
            5=>$this->manejable->getTiempo(),
            6=>$this->manejable->getTotal(),
            7=>$this->manejable->getDescuento());
        return $av;
    }
    
    public function generarAVTransaccionProductos($actual){
        $av = array();
        $av[0]=array(0=>"`k_id_producto`",
            1=>"`k_id_transaccion`",
            2=>"`q_producto`",
            3=>"`v_precio_venta`");
        $av[1]=array(0=>$this->manejable->getProductos()[$actual]->getId(),
            1=>$this->manejable->getId(),
            2=>$this->manejable->getCantidadProductos()[$actual],
            3=>$this->manejable->getProductos()[$actual]->getPrecio());
        return $av;
    }
    
    public function obtenerIdSucursal($nombre){
        $this->abrirConexion();
        $query = "SELECT `k_id_sucursal` FROM `sucursal` WHERE `n_nombre`='$nombre'";
        $resultado = mysql_fetch_array(mysql_query($query))[0][0];
        $this->cerrarConexion();
        return $resultado;
    }
    
    public function obtenerNombreSucursal($id){
        $this->abrirConexion();
        $query = "SELECT `n_nombre` FROM `sucursal` WHERE `k_id_sucursal`='$id'";
        $resultado = mysql_fetch_array(mysql_query($query))[0][0];
        $this->cerrarConexion();
        return $resultado;
    }
    
    public function getManejadorProductos(){
        return $this->manejadorProductos;
    }
    
    public function getManejadorUsuarios(){
        return $this->manejadorUsuarios;
    }
}
?>