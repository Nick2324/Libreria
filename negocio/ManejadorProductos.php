<?php
namespace Manejadores;

require_once ('Producto.php');
require_once ('Libro.php');
require_once ('Video.php');
require_once ('Manejador.php');

use Productos\Producto;
use Productos\Libro;
use Productos\Video;
use Manejadores;

class ManejadorProductos extends Manejador{

    function __construct(){}

    function __destruct(){}

    public function actualizarProducto(){
        if($this->integridadProducto()){
            if($this->manejable instanceof Libro && $this->integridadLibro()){
                $this->update("producto", $this->generarParesAVProducto());
                $this->update("libro", $this->generarParesAVLibro());
                return true;
            }else if($this->manejable instanceof Video && $this->integridadVideo()){
                $this->update("producto", $this->generarParesAVProducto());
                $this->update("video", $this->generarParesAVVideo());
                return true;
            }else{
                $this->update("producto", $this->generarParesAVProducto());
                return true;
            }
        }
        return false;
    }
    
    public function cambiarEstadoProducto(){
        $this->abrirConexion();
        if($this->manejable->getInventarioActivo() == "Activo")
            $this->manejable->setInventarioActivo("Inactivo");
        else if($this->manejable->getInventarioActivo() == "Inactivo")
            $this->manejable->setInventarioActivo("Activo");
        $query = "UPDATE `producto` SET `i_inventario`='".$this->conversionInventario()."
            ' WHERE `k_id_producto`='".$this->manejable->getId()."'";
        $resultado = mysql_query($query);
        $this->cerrarConexion();
        return $resultado;
    }

    public function buscarProducto(){
        $coincidencias = array();
        $av = $this->generarParesAVProducto();
        $coincidencias = $this->fetchProducto($coincidencias,$this->select("producto", $av));
        if($this->manejable instanceof Libro){
            $av = $this->generarParesAVLibro();
            $coincidencias = $this->fetchLibro($coincidencias,$this->select("libro", $av));
            $coincidencias = $this->eliminarNoCoincidentes($coincidencias);
        }else if($this->manejable instanceof Video){
            $av = $this->generarParesAVVideo();
            $coincidencias =$this->fetchVideo($coincidencias,$this->select("video", $av));
            $coincidencias = $this->eliminarNoCoincidentes($coincidencias);
        }else{
            $av = null;
            $av = array();
            $av[0] = array(0=>"`k_id_producto`");
            for($i=0;$i<count($coincidencias);$i++){
                $av[1] = array(0=>$coincidencias[$i]->getId());
                $resultado = $this->fetchLibro(array(0=>$coincidencias[$i]),$this->select("libro",$av));
                if(!($resultado[0] instanceof Libro))
                    $resultado = $this->fetchVideo(array(0=>$coincidencias[$i]),$this->select("video",$av));
                $coincidencias[$i] = $resultado[0];
            }
        }
        return $coincidencias;
    }

    public function construirManejable($partes){
        if($partes['tipo_producto']=="libro")
            $this->manejable = new Libro;
        else if($partes['tipo_producto']=="video")
            $this->manejable = new Video;
        else
            $this->manejable = new Producto;
        $this->manejable->setId($partes['id']);
        $this->manejable->setNombre($partes['nombre']);
        $this->manejable->setDescripcion($partes['descripcion']);
        if($partes['transaccionalidad']!="Seleccion")
            $this->manejable->setTransaccionalidad($partes['transaccionalidad']);
        $this->manejable->setFechaEdicion($partes['fecha_edicion']);
        $this->manejable->setPrecio($partes['precio']);
        $this->manejable->setStock($partes['stock']);
        $this->manejable->setFormato($this->getIdFormato($partes['formato']));
        $this->manejable->setIdioma($this->getIdIdioma($partes['idioma']));
        $this->manejable->setInventarioActivo($partes['inventario']);
        $this->manejable->setPrestado($partes['prestado']);
        if($this->manejable instanceof Libro){
            $this->manejable->setAutores($partes['autor']);
            $this->manejable->setEditorial($partes['editorial']);
            if($partes['genero']!="Seleccion")
                $this->manejable->setGenero($partes['genero']);
            $this->manejable->setMateria($partes['materia']);
        }else if($this->manejable instanceof Video){
            if($partes['tipo']!="Seleccion")
                $this->manejable->setTipo($partes['tipo']);
            $this->manejable->setProductor($partes['productor']);
            $this->manejable->setDirector($partes['director']);
        }
    }

    public function crearProducto(){
        if($this->manejable instanceof Libro || $this->manejable instanceof Video){
            if($this->manejable->getNombre()!=null &&
               $this->manejable->getDescripcion()!=null &&
               $this->manejable->getTransaccionalidad()!=null &&
               $this->manejable->getFechaEdicion()!=null &&
               $this->manejable->getPrecio()!=null &&
               $this->manejable->getStock()!=null &&
               $this->manejable->getFormato()!=null &&
               $this->manejable->getIdioma()!=null &&
               $this->manejable->getInventarioActivo()!=null &&
               $this->integridadProducto()){
                $this->manejable->setId($this->generarId("producto")+1);
                if($this->manejable->getTransaccionalidad()=="Prestamo")
                    $this->manejable->setPrestado(0);
                if($this->manejable instanceof Libro){
                    if($this->manejable->getAutores()!=null &&
                       $this->manejable->getEditorial()!=null &&
                       $this->manejable->getGenero()!=null &&
                       $this->manejable->getMateria()!=null  && 
                       $this->integridadLibro()){
                        $this->manejable->setIdLibro($this->generarId("libro")+1);
                        return $this->insert("producto",$this->generarParesAVProducto())&&
                            $this->insert("libro", $this->generarParesAVLibro());
                    }
                }else if($this->manejable instanceof Video){
                    if($this->manejable->getProductor()!=null &&
                       $this->manejable->getTipo()!=null &&
                       $this->manejable->getDirector()!=null &&
                       $this->integridadVideo()){
                        $this->manejable->setIdVideo($this->generarId("video")+1);
                        return $this->insert("producto",$this->generarParesAVProducto())&&
                            $this->insert("video", $this->generarParesAVVideo());
                    }
                }
            }
        }
        return false;
    }
    
    public function getIdIdioma($valor){
        $this->abrirConexion();
        $resultado = mysql_fetch_array(mysql_query("SELECT `k_id_idioma` FROM `idioma` WHERE `n_nombre`='".$valor."'"))[0];
        $this->cerrarConexion();
        return $resultado;
    }
    
    public function getIdFormato($valor){
        $this->abrirConexion();
        $resultado = mysql_fetch_array(mysql_query("SELECT `k_id_formato` FROM `formato` WHERE `n_nombre`='".$valor."'"))[0];
        $this->cerrarConexion();
        return $resultado;
    }
    
    public function getNombreFormato($id){
        $this->abrirConexion();
        $resultado = mysql_fetch_array(mysql_query("SELECT `n_nombre` FROM `formato` WHERE `k_id_formato`='".$id."'"))[0];
        $this->cerrarConexion();
        return $resultado;
    }
    
    public function getNombreIdioma($id){
        $this->abrirConexion();
        $resultado = mysql_fetch_array(mysql_query("SELECT `n_nombre` FROM `idioma` WHERE `k_id_idioma`='".$id."'"))[0];
        $this->cerrarConexion();
        return $resultado;
    }
    
    public function fetchProducto($coincidencias,$arrayQuery){
        $i = 0;
        while($fila = mysql_fetch_array($arrayQuery)){
            $producto = new Producto;
            $producto->setId($fila[0]);
            $producto->setIdioma($this->getNombreIdioma($fila[1]));
            $producto->setNombre($fila[2]);
            $producto->setTransaccionalidad($fila[3]);
            $producto->setInventarioActivo($this->deconversionInventario($fila[4]));
            $producto->setDescripcion($fila[5]);
            $producto->setFechaEdicion($fila[6]);
            $producto->setStock($fila[7]);
            $producto->setPrecio($fila[8]);
            $producto->setFormato($this->getNombreFormato($fila[9]));
            $producto->setPrestado($fila[10]);
            $coincidencias[$i] = $producto;
            $i++;
        }
        return $coincidencias;
    }
    
    public function fetchLibro($coincidencias,$arrayQuery){
        while($fila = mysql_fetch_array($arrayQuery)){
            for($i=0;$i<count($coincidencias);$i++){
                if($fila[0] == $coincidencias[$i]->getId()){
                    $libro = $this->settingProducto("libro", $coincidencias[$i]);
                    $libro->setGenero($fila[1]);
                    $libro->setEditorial($fila[2]);
                    $libro->setMateria($fila[3]);
                    $libro->setAutores($fila[4]);
                    $libro->setIdLibro($fila[5]);
                    $coincidencias[$i] = $libro;
                    break;
                }
            }
        }
        return $coincidencias;
    }
    
    public function fetchVideo($coincidencias,$arrayQuery){
        while($fila = mysql_fetch_array($arrayQuery)){
            for($i=0;$i<count($coincidencias);$i++){
                if($fila[1] == $coincidencias[$i]->getId()){
                    $video = $this->settingProducto("video", $coincidencias[$i]);
                    $video->setIdVideo($fila[0]);
                    $video->setProductor($fila[2]);
                    $video->setDirector($fila[3]);
                    $video->setTipo($fila[4]);
                    $coincidencias[$i] = $video;
                    break;
                }
            }
        }
        return $coincidencias;
    }
    
    public function settingProducto($tipo,$setting){
        $producto = null;
        if($tipo == "video")
            $producto = new Video;
        else if($tipo == "libro")
            $producto = new Libro;
        $producto->setId($setting->getId());
        $producto->setIdioma($setting->getIdioma());
        $producto->setNombre($setting->getNombre());
        $producto->setTransaccionalidad($setting->getTransaccionalidad());
        $producto->setInventarioActivo($setting->getInventarioActivo());
        $producto->setDescripcion($setting->getDescripcion());
        $producto->setFechaEdicion($setting->getFechaEdicion());
        $producto->setStock($setting->getStock());
        $producto->setPrecio($setting->getPrecio());
        $producto->setFormato($setting->getFormato());
        $producto->setPrestado($setting->getPrestado());
        return $producto;
    }
    
    public function eliminarNoCoincidentes($coincidencias){
        for($i=0;$i<count($coincidencias);$i++)
            if(!($coincidencias[$i] instanceof Libro || $coincidencias[$i] instanceof Video)){
                for($j=$i;$j<count($coincidencias)-1;$j++)
                    $coincidencias[$j] = $coincidencias[$j+1];
                unset($coincidencias[count($coincidencias)-1]);
                $i--;
            }
        return $coincidencias;
    }
    
    public function generarParesAVProducto(){
        $av = array();
        $av[0]=array(0=>"`k_id_producto`",
            1=>"`k_id_idioma`",
            2=>"`n_nombre`",
            3=>"`i_transaccionalidad`",
            4=>"`i_inventario`",
            5=>"`n_descripcion`",
            6=>"`f_fecha_edicion`",
            7=>"`q_stock`",
            8=>"`v_precio`",
            9=>"`k_id_formato`",
            10=>"`q_prestada`");
        $av[1]=array(0=>$this->manejable->getId(),
            1=>$this->manejable->getIdioma(),
            2=>$this->manejable->getNombre(),
            3=>$this->manejable->getTransaccionalidad(),
            4=>$this->conversionInventario(),
            5=>$this->manejable->getDescripcion(),
            6=>$this->manejable->getFechaEdicion(),
            7=>$this->manejable->getStock(),
            8=>$this->manejable->getPrecio(),
            9=>$this->manejable->getFormato(),
            10=>$this->manejable->getPrestado());
        return $av;
    }
    
    public function generarParesAVLibro(){
        $av = array();
        $av[0] = array(0=>"`k_id_producto`",
            1=>"`id_libro`",
            2=>"`n_editorial`",
            3=>"`n_materia`",
            4=>"`n_autor`",
            5=>"`n_genero`");
        $av[1] = array(0=>$this->manejable->getId(),
            1=>$this->manejable->getIdLibro(),
            2=>$this->manejable->getEditorial(),
            3=>$this->manejable->getMateria(),
            4=>$this->manejable->getAutores(),
            5=>$this->manejable->getGenero());
        return $av;
    }
    
    public function generarParesAVVideo(){
        $av = array();
        $av[0] = array(
            0=>"`k_id_producto`",
            1=>"`id_video`",
            2=>"`n_productor`",
            3=>"`n_director`",
            4=>"`n_tipo`");
        $av[1] = array(0=>$this->manejable->getId(),
            1=>$this->manejable->getIdVideo(),
            2=>$this->manejable->getProductor(),
            3=>$this->manejable->getDirector(),
            4=>$this->manejable->getTipo());
        return $av;
    }
    
    public function integridadProducto(){
        $integro = true;
        if(($this->manejable->getNombre()!=null && strlen($this->manejable->getNombre())>20) ||
           ($this->manejable->getDescripcion()!=null && strlen($this->manejable->getDescripcion())>350) ||
           ($this->manejable->getStock()!=null && $this->manejable->getStock()<0) || 
           (($this->manejable->getStock()!=null && $this->manejable->getPrestado()!=null)
                   && ($this->manejable->getStock()<$this->manejable->getPrestado())) || 
           ($this->manejable->getPrecio()!=null && $this->manejable->getPrecio()<0))
                $integro = false;
        return $integro;
    }
    
    public function integridadLibro(){
        $integro = true;
        if(($this->manejable->getAutores()!=null && strlen($this->manejable->getAutores())>40) ||
           ($this->manejable->getEditorial()!=null && strlen($this->manejable->getEditorial())>20) ||
           ($this->manejable->getMateria()!=null && strlen($this->manejable->getMateria())>20))
                $integro = false;
        return $integro;
    }
    
    public function integridadVideo(){
        $integro = true;
        if(($this->manejable->getDirector()!=null && strlen($this->manejable->getDirector())>30) ||
           ($this->manejable->getProductor()!=null && strlen($this->manejable->getProductor())>30))
                $integro = false;
        return $integro;
    }
    
    public function conversionInventario(){
        if($this->manejable->getInventarioActivo()=="Activo")
            return 1;
        else if($this->manejable->getInventarioActivo()=="Inactivo")
            return 2;
    }
    
    public function deconversionInventario($inventario){
        if($inventario==1)
            return "Activo";
        else if($inventario==2)
            return "Inactivo";
    }
}
?>