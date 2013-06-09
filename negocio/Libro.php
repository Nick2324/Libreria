<?php
namespace Productos;

require_once ('Producto.php');

use Productos;

class Libro extends Producto implements \JsonSerializable{

    private $idLibro;
    private $autores;
    private $editorial;
    private $genero;
    private $materia;

    function __construct(){}

    function __destruct(){}

    public function getAutores(){
        return $this->autores;
    }

    public function getEditorial(){
        return $this->editorial;
    }

    public function getGenero(){
        return $this->genero;
    }

    public function getMateria(){
        return $this->materia;
    }

    public function getIdLibro(){
        return $this->idLibro;
    }

    public function setAutores($autores){
        $this->autores = $autores;
    }

    public function setEditorial($editorial){
        $this->editorial = $editorial;
    }

    public function setGenero($genero){
        $this->genero = $genero;
    }

    public function setMateria($materia){
        $this->materia = $materia;
    }

    public function setIdLibro($idLibro){
        $this->idLibro = $idLibro;
    }

    public function jsonSerialize() {
        return array_merge(Producto::jsonSerialize(),["idLibro"=>  $this->idLibro,
            "autores"=>  $this->autores,
            "editorial"=>$this->editorial,
            "genero"=>$this->genero,
            "materia"=>  $this->materia]);
    }

}
?>