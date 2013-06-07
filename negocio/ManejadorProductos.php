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
                4=>$this->manejable->getInventarioActivo(),
                5=>$this->manejable->getDescripcion(),
                6=>$this->manejable->getFechaEdicion(),
                7=>$this->manejable->getStock(),
                8=>$this->manejable->getPrecio(),
                9=>$this->manejable->getFormato(),
                10=>$this->manejable->getPrestado());
        $this->update("producto", $av);
        if($this->manejable instanceof Libro){
            $av[0] = array(0=>"`k_id_producto`",
                    1=>"`n_genero`",
                    2=>"`n_editorial`",
                    3=>"`n_materia`",
                    4=>"`n_autor`",
                    5=>"`id_libro`");
            $av[1] = array(0=>$this->manejable->getId(),
                1=>$this->manejable->getGenero(),
                2=>$this->manejable->getEditorial(),
                3=>$this->manejable->getMateria(),
                4=>$this->manejable->getAutores(),
                5=>$this->manejable->getIdLibro());
            $this->update("libro", $av);
        }else if($this->manejable instanceof Video){
            $av[0] = array(0=>"`k_id_producto`",
                    1=>"`id_video`",
                    2=>"`n_productor`",
                    3=>"`n_director`",
                    4=>"`n_tipo`");
            $av[1] = array(0=>$this->manejable->getId(),
                1=>$this->manejable->getIdVideo(),
                2=>$this->manejable->getProductor(),
                3=>$this->manejable->getDirector(),
                4=>$this->manejable->getTipo());
            $this->update("video", $av);
        }
    }
    
    public function actualizarLibro(){}

    public function actualizarVideo(){}

    public function borrarProducto(){}
    

    public function buscarProducto(){
        $coincidencias = array();
        if($this->manejable->getId()!=null){
            
        }else{
            $avProducto = array();
            $avTipo = array();
            $avProducto[0]=array(0=>"`k_id_producto`",
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
            $avProducto[1]=array(0=>$this->manejable->getId(),
                1=>$this->manejable->getIdioma(),
                2=>$this->manejable->getNombre(),
                3=>$this->manejable->getTransaccionalidad(),
                4=>$this->manejable->getInventarioActivo(),
                5=>$this->manejable->getDescripcion(),
                6=>$this->manejable->getFechaEdicion(),
                7=>$this->manejable->getStock(),
                8=>$this->manejable->getPrecio(),
                9=>$this->manejable->getFormato(),
                10=>$this->manejable->getPrestado());
            $coincidencias = $this->fetchProducto($coincidencias,$this->select("producto", $avProducto));
            if($this->manejable instanceof Libro){
                $avTipo[0] = array(0=>"`n_genero`",
                    1=>"`n_editorial`",
                    2=>"`n_materia`",
                    3=>"`n_autor`",
                    4=>"`id_libro`");
                $avTipo[1] = array(0=>$this->manejable->getGenero(),
                    1=>$this->manejable->getEditorial(),
                    2=>$this->manejable->getMateria(),
                    3=>$this->manejable->getAutores(),
                    4=>$this->manejable->getIdLibro());
                $coincidencias =$this->fetchLibro($coincidencias,$this->select("libro", $avTipo));
            }else if($this->manejable instanceof Video){
                $avTipo[0] = array(0=>"`id_video`",
                    1=>"`n_productor`",
                    2=>"`n_director`",
                    3=>"`n_tipo`");
                $avTipo[1] = array(0=>$this->manejable->getIdVideo(),
                    1=>$this->manejable->getProductor(),
                    2=>$this->manejable->getDirector(),
                    3=>$this->manejable->getTipo());
                $coincidencias =$this->fetchLibro($coincidencias,$this->select("video", $avTipo));
            }else{
                $avTipo[0] = array(0=>"`k_id_producto`");
                for($i=0;$i<count($coincidencias);$i++){
                    $avTipo[1] = array(0=>$coincidencias[$i]->getId());
                    $resultado = $this->fetchLibro(array(0=>$coincidencias[$i]),$this->select("libro",$avTipo));
                    if(count($resultado)==0)
                        $resultado = $this->fetchVideo(array(0=>$coincidencias[$i]),$this->select("video",$avTipo));
                    $coincidencias[$i] = $resultado[0];
                }
            }
        }
        print_r($coincidencias);
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
        $this->manejable->setTransaccionalidad($partes['transaccionalidad']);
        $this->manejable->setFechaEdicion($partes['fecha_edicion']);
        $this->manejable->setPrecio($partes['precio']);
        $this->manejable->setStock($partes['stock']);
        $this->manejable->setFormato($this->getIdFormato($partes['formato']));
        $this->manejable->setIdioma($this->getIdIdioma($partes['idioma']));
        if($partes['inventario']!=null && $partes['inventario']=="Activo")
            $this->manejable->setInventarioActivo(1);
        else if($partes['inventario']!=null && $partes['inventario']=="Inactivo")
            $this->manejable->setInventarioActivo(2);
        $this->manejable->setPrestado($partes['prestado']);
        if($this->manejable instanceof Libro){
            $this->manejable->setAutores($partes['autor']);
            $this->manejable->setEditorial($partes['editorial']);
            $this->manejable->setGenero($partes['genero']);
            $this->manejable->setMateria($partes['materia']);
        }else if($this->manejable instanceof Video){
            $this->manejable->setTipo($partes['tipo']);
            $this->manejable->setProductor($partes['productor']);
            $this->manejable->setDirector($partes['director']);
        }
    }

    public function construirManejableCambio($partes){
        
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
               $this->manejable->getInventarioActivo()!=null){
                $this->manejable->setId($this->generarId("producto")+1);
                if($this->manejable->getTransaccionalidad()=="Prestamo")
                    $this->manejable->setPrestado(0);
                else
                    $this->manejable->setPrestado("NULL");
                $query_producto = "INSERT INTO `producto` 
                            (`k_id_producto`, `k_id_idioma`, `n_nombre`, 
                            `i_transaccionalidad`, `i_inventario`, `n_descripcion`,
                            `f_fecha_edicion`, `q_stock`, `v_precio`, `k_id_formato`, 
                            `q_prestada`) 
                            VALUES
                            (".$this->manejable->getId().",
                             ".$this->manejable->getIdioma().",'
                             ".$this->manejable->getNombre()."','
                             ".$this->manejable->getTransaccionalidad()."',
                             ".$this->manejable->getInventarioActivo().",'
                             ".$this->manejable->getDescripcion()."',
                             CAST('".$this->manejable->getFechaEdicion()."' AS DATE),
                             ".$this->manejable->getStock().",
                             ".$this->manejable->getPrecio().",
                             ".$this->manejable->getFormato().",
                             ".$this->manejable->getPrestado().")";
                if($this->manejable instanceof Libro){
                    echo "fadf ".($this->manejable instanceof Libro || $this->manejable instanceof Video);
                    if($this->manejable->getAutores()!=null &&
                       $this->manejable->getEditorial()!=null &&
                       $this->manejable->getGenero()!=null &&
                       $this->manejable->getMateria()!=null){
                        $this->manejable->setIdLibro($this->generarId("libro")+1);
                        $this->abrirConexion();
                        $query_libro = "INSERT INTO `libro` (`k_id_producto`, 
                            `n_genero`, `n_editorial`, `n_materia`, `id_libro`) 
                            VALUES
                            (".$this->manejable->getId().",'".$this->manejable->getGenero()."
                                ','".$this->manejable->getEditorial()."','
                                    ".$this->manejable->getMateria()."',
                                    ".$this->manejable->getIdLibro().")";
                        $resultado = mysql_query($query_producto) && mysql_query($query_libro);
                        $this->cerrarConexion();
                        return $resultado;
                    }
                }else if($this->manejable instanceof Video){
                    if($this->manejable->getProductor()!=null &&
                       $this->manejable->getTipo()!=null &&
                       $this->manejable->getDirector()!=null){
                        $this->manejable->setIdVideo($this->generarId("video")+1);
                        $this->abrirConexion();
                        $query_video = "INSERT INTO `video`
                            (`id_video`, `k_id_producto`, `n_productor`,
                            `n_director`, `n_tipo`) 
                            VALUES 
                            (".$this->manejable->getIdVideo().",
                            ".$this->manejable->getId().",'
                            ".$this->manejable->getProductor()."','
                            ".$this->manejable->getDirector()."','
                            ".$this->manejable->getTipo()."')";
                        $resultado = mysql_query($query_producto);
                        if($resultado)
                            mysql_query($query_video);
                        $this->cerrarConexion();
                        return $resultado;
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
            if($fila[4]==1)
                $fila[4]="Activo";
            else if($fila[4]==2)
                $fila[4]="Inactivo";
            $producto->setInventarioActivo($fila[4]);
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
        $i=0;
        while($fila = mysql_fetch_array($arrayQuery)){
            $libro = $this->settingProducto("libro", $coincidencias[$i]);
            $libro->setGenero($fila[1]);
            $libro->setEditorial($fila[2]);
            $libro->setMateria($fila[3]);
            $libro->setAutores($fila[4]);
            $libro->setIdLibro($fila[5]);
            $coincidencias[$i] = $libro;
            $i++;
        }
        if($i==0)
            return null;
        return $coincidencias;
    }
    
    public function fetchVideo($coincidencias,$arrayQuery){
        $i=0;
        while($fila = mysql_fetch_array($arrayQuery)){
            $video = $this->settingProducto("video", $coincidencias[$i]);
            $video->setIdVideo($fila[0]);
            $video->setProductor($fila[2]);
            $video->setDirector($fila[3]);
            $video->setTipo($fila[4]);
            $coincidencias[$i] = $video;
            $i++;
        }
        if($i==0)
            return null;
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
}
?>