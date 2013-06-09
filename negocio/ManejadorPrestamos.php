<?php

namespace Manejadores;

require_once ('Manejador.php');
require_once ('ManejadorProductos.php');
require_once ('Prestamo.php');


use Manejadores;
use Prestamo\Prestamo;

class ManejadorPrestamos extends Manejador{
    
    function __construct(){}

    function __destruct(){}

    public function construirManejable($partes) {
        $this->manejable = new Prestamo;
        $this->manejable->setIdCliente($partes["id_cliente"]);
        $this->manejable->setIdTransaccion($partes["id_transaccion"]);
        $this->manejable->setIdProducto($partes["id_producto"]);
        $this->manejable->setMoroso($partes['moroso']);
        $this->manejable->setPrestado($partes['prestado']);
    }
    
    public function condonarPrestamo(){
        $this->manejable->setPrestado(mysql_fetch_array($this->select("prestamo", $this->generarParesAVPrestamo()))[4]);
        if($this->manejable->getPrestado()!=null){
            $this->delete("prestamo", $this->generarParesAVPrestamo());
            $manejadorProductos = new ManejadorProductos;
            $manejadorProductos->construirManejable(array("id"=>$this->manejable->getIdProducto()));
            $nuevoPrestado = $manejadorProductos->buscarProducto()[0]->getPrestado() - $this->manejable->getPrestado();
            $manejadorProductos->construirManejable(array("id"=>$this->manejable->getIdProducto(),
                "prestado"=>$nuevoPrestado));
            $manejadorProductos->actualizarProducto();
            return true;
        }
        return false;
    }
    
    public function adicionarPrestamo(){
        $this->manejable->setMoroso("No");
        $resultado = $this->insert("prestamo", $this->generarParesAVPrestamo());
        return $resultado;
    }
    
    public function generarParesAVPrestamo(){
        $av = array();
        $av[0]=array(0=>"`k_id_cliente`",
            1=>"`k_id_transaccion`",
            2=>"`k_id_producto`",
            3=>"`i_moroso`",
            4=>"`q_prestada`");
        $av[1]=array(0=>$this->manejable->getIdCliente(),
            1=>$this->manejable->getIdTransaccion(),
            2=>$this->manejable->getIdProducto(),
            3=>$this->manejable->getMoroso(),
            4=>$this->manejable->getPrestado());
        return $av;
    }
    
}

?>
