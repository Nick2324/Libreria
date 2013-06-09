<?php

namespace Productos;

use Productos;

class Producto implements \JsonSerializable{

    protected $id;
    protected $descripcion;
    protected $transaccionalidad;
    protected $fechaEdicion;
    protected $formato;
    protected $idioma;
    protected $inventarioActivo;
    protected $nombre;
    protected $precio;
    protected $prestado;
    protected $stock;

    function __construct(){}

    function __destruct(){}

    public function getId(){
        return $this->id;
    }            

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getTransaccionalidad(){
        return $this->transaccionalidad;
    }

    public function getFechaEdicion(){
        return $this->fechaEdicion;
    }

    public function getFormato(){
        return $this->formato;
    }

    public function getIdioma(){
        return $this->idioma;
    }

    public function getInventarioActivo(){
        return $this->inventarioActivo;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getPrecio(){
        return $this->precio;
    }
    
    public function getPrestado(){
        return $this->prestado;
    }

    public function getStock(){
        return $this->stock;
    }

    public function setId($idProducto){
        $this->id = $idProducto;
    }
    
    public function setIdioma($idioma){
        $this->idioma = $idioma;
    }
    
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function setTransaccionalidad($transaccionalidad){
        $this->transaccionalidad = $transaccionalidad;
    }

    public function setFechaEdicion($fechaEdicion){
        $this->fechaEdicion = $fechaEdicion;
    }
    
    public function setFormato($formato){
        $this->formato = $formato;
    }

    public function setInventarioActivo($inventarioActivo){
        $this->inventarioActivo = $inventarioActivo;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }

    public function setPrestado($prestado){
        $this->prestado = $prestado;
    }
    
    public function setStock($stock){
        $this->stock = $stock;
    }

    public function jsonSerialize() {
        return ["id"=>  $this->id,
        "descripcion"=>  $this->descripcion,
        "transaccionalidad"=>  $this->transaccionalidad,
        "fechaEdicion"=> $this->fechaEdicion,
        "formato"=>  $this->formato,
        "idioma"=>  $this->idioma,
        "inventarioActivo"=>  $this->inventarioActivo,
        "nombre"=>  $this->nombre,
        "precio"=>  $this->precio,
        "prestado"=>  $this->prestado,
        "stock"=>  $this->stock];
    }

}
?>