<?php

namespace Manejadores;

require_once ('Usuario.php');
require_once ('Cliente.php');
require_once ('ClienteAfiliado.php');
require_once ('Vendedor.php');
require_once ('TipoUsuario.php');
require_once ('Manejador.php');

use Usuarios\Usuario;
use Usuarios\Cliente;
use Usuarios\ClienteAfiliado;
use Usuarios\Vendedor;
use Manejadores;

class ManejadorUsuarios extends Manejador{
    
    function __construct(){}

    function __destruct(){}

    public function actualizarUsuario(){
        if($this->manejable->getIdentificacion()!=null){
            return $this->update("usuario", $this->generarAVUsuario());
        }
        return false;
    }

    public function cambiarEstadoUsuario(){
        if($this->manejable->getActivo()!=null &&
           $this->manejable->getActivo() == 1)
            $this->manejable->setActivo(2);
        else if($this->manejable->getActivo()!=null &&
           $this->manejable->getActivo() == 2)
            $this->manejable->setActivo(1);
        if($this->manejable->getIdentificacion()!=null &&
           $this->manejable->getActivo()!=null)
            return $this->update("usuario", $this->generarAVUsuario());
        else{
            echo $this->manejable->getActivo();
            return false;
        }
    }

    public function buscarUsuario(){
        $coincidencias = array();
        $coincidencias = $this->fetchUsuario($coincidencias, $this->select("usuario", $this->generarAVUsuario()));
        $coincidencias = $this->fetchVendedor($coincidencias, $this->select("vendedor", $this->generarAVVendedor()));
        $coincidencias = $this->fetchCliente($coincidencias, $this->select("cliente", $this->generarAVCliente()));
        $coincidencias = $this->fetchClienteAfiliado($coincidencias, $this->select("cliente_afiliado", $this->generarAVClienteAfiliado()));
        //$coincidencias = $this->eliminarNoCoincidentes($coincidencias);
        return $coincidencias;
    }

    public function construirManejable($partes){
        $this->manejable = new Usuario;
        $this->manejable->setIdentificacion($partes['identificacion']);
        $this->manejable->setNombre($partes['nombre']);
        $this->manejable->setCorreo($partes['correoElectronico']);
        $this->manejable->setTelefono($partes['telefono']);
        $this->manejable->setDireccion($partes['direccion']);
        if($partes['activo']=="activo")
            $this->manejable->setActivo(1);
        else if($partes['activo']=="inactivo")
            $this->manejable->setActivo(2);
    }

    public function crearUsuario(){
        if($this->manejable->getIdentificacion()!=null &&
           $this->manejable->getNombre()!=null &&
           $this->manejable->getCorreo()!=null &&
           $this->manejable->getTelefono()!=null &&
           $this->manejable->getDireccion()!=null &&
           $this->manejable->getActivo()!=null){
            $resultado = $this->insert("usuario", $this->generarAVUsuario());
            $this->crearTodosLosPerfiles();
            return $resultado;
        }
        return false;
    }
    
    public function crearTodosLosPerfiles(){
        $query_cliente = "INSERT INTO `cliente`(`k_id_cliente`, `k_id_usuario`)
            VALUES 
            (".($this->generarId("cliente")+1).",
             ".$this->manejable->getIdentificacion().")";
        $query_cliente_afiliado = "INSERT INTO `cliente_afiliado`
            (`k_id_usuario`,`k_id_cliente`, `i_tipo_afiliacion`, 
            `i_estado_afiliacion`, `f_afiliacion`) 
            VALUES 
            (".$this->manejable->getIdentificacion().",".$this->generarId("cliente").",'a',CURDATE())";
        $query_vendedor = "INSERT INTO `vendedor`
            (`k_id_vendedor`, `k_id_usuario`) 
            VALUES 
            (".($this->generarId("vendedor")+1).",".$this->manejable->getIdentificacion().")";
        $query_perfil = "INSERT INTO `perfil`(`k_id_perfil`, `n_nombre_usuario`,
            `o_contrasenia`, `n_tipo`, `k_id_usuario`)
            VALUES (".($this->generarId("perfil")+1).",
                    'usuario".$this->generarId("perfil")."',
                    '123456',
                    'Administrador',
                    ".$this->manejable->getIdentificacion().")";
        $this->abrirConexion();
        mysql_query($query_cliente);
        mysql_query($query_cliente_afiliado);
        mysql_query($query_vendedor);
        mysql_query($query_perfil);
        $this->cerrarConexion();
    }
    
    public function generarAVUsuario(){
        $av = array();
        $av[0]=array(0=>"`k_id_usuario`",
            1=>"`n_nombre`",
            2=>"`n_correo`",
            3=>"`n_direccion`",
            4=>"`o_telefono`",
            5=>"`i_activo`");
        $av[1]=array(0=>$this->manejable->getIdentificacion(),
            1=>$this->manejable->getNombre(),
            2=>$this->manejable->getCorreo(),
            3=>$this->manejable->getDireccion(),
            4=>$this->manejable->getTelefono(),
            5=>$this->manejable->getActivo());
        return $av;
    }
    
    public function generarAVCliente(){
        $av = array();
        $av[0]=array(0=>"`k_id_cliente`",
            1=>"`k_id_usuario`");
        $i = null;
        for($i=0;$i<count($this->manejable->getTipoUsuarios());$i++)
            if($this->manejable->getTipoUsuarios()[$i] instanceof Cliente &&
               !($this->manejable->getTipoUsuarios()[$i] instanceof ClienteAfiliado))
                break;
        if($this->manejable->getTipoUsuarios()[$i]!=null)
            $av[1]=array(0=>$this->manejable->getTipoUsuarios()[$i]->getIdCliente(),
                1=>$this->manejable->getIdentificacion());
        else
            $av[1]=array(0=>null,
                1=>$this->manejable->getIdentificacion());
        return $av;
    }
    
    public function generarAVClienteAfiliado(){
        $av = array();
        $av[0]=array(0=>"`k_id_usuario`",
            1=>"`k_id_cliente`",
            2=>"`i_tipo_afiliacion`",
            3=>"`i_estado_afiliacion`",
            4=>"`f_afiliacion`");
        $i = null;
        for($i=0;$i<count($this->manejable->getTipoUsuarios());$i++)
            if($this->manejable->getTipoUsuarios()[$i] instanceof ClienteAfiliado)
                break;
        if($this->manejable->getTipoUsuarios()[$i]!=null)
            $av[1]=array(0=>$this->manejable->getIdentificacion(),
                1=>$this->manejable->getTipoUsuarios()[$i]->getIdCliente(),
                2=>$this->manejable->getTipoUsuarios()[$i]->getTipoAfiliacion(),
                3=>$this->manejable->getTipoUsuarios()[$i]->getAfiliacionActiva(),
                4=>$this->manejable->getTipoUsuarios()[$i]->getFechaAfiliacion());
        else
            $av[1]=array(0=>$this->manejable->getIdentificacion(),
                1=>null,
                2=>null,
                3=>null,
                4=>null);
        return $av;
    }
    
    public function generarAVVendedor(){
        $av = array();
        $av[0]=array(0=>"`k_id_vendedor`",
            1=>"`k_id_usuario`");
        $i = null;
        for($i=0;$i<count($this->manejable->getTipoUsuarios());$i++)
            if($this->manejable->getTipoUsuarios()[$i] instanceof Vendedor)
                break;
        if($this->manejable->getTipoUsuarios()[$i]!=null)
            $av[1]=array(0=>$this->manejable->getTipoUsuarios()[$i]->getIdVendedor(),
                1=>$this->manejable->getIdentificacion());
        else
            $av[1]=array(0=>null,
                1=>$this->manejable->getIdentificacion());
        return $av;
    }
    
    public function fetchUsuario($coincidencias,$arrayQuery){
        $i=0;
        while($fila = mysql_fetch_array($arrayQuery)){
            $usuario = new Usuario;
            $usuario->setIdentificacion($fila[0]);
            $usuario->setNombre($fila[1]);
            $usuario->setCorreo($fila[2]);
            $usuario->setDireccion($fila[3]);
            $usuario->setTelefono($fila[4]);
            $usuario->setActivo($fila[5]);
            $coincidencias[$i++] = $usuario;
        }
        return $coincidencias;
    }
    
    public function fetchCliente($coincidencias,$arrayQuery){
        while($fila = mysql_fetch_array($arrayQuery)){
            for($i=0;$i<count($coincidencias);$i++)
                if($coincidencias[$i]->getIdentificacion() == $fila[1]){
                    $cliente = new Cliente;
                    $cliente->setIdCliente($fila[0]);
                    $tipoUsuarios = $coincidencias[$i]->getTipoUsuarios();
                    $tipoUsuarios[1] = $cliente;
                    $coincidencias[$i]->setTipoUsuarios($tipoUsuarios);
                    break;
                }
        }
        return $coincidencias;
    }
    
    public function fetchClienteAfiliado($coincidencias,$arrayQuery){
        while($fila = mysql_fetch_array($arrayQuery)){
            for($i=0;$i<count($coincidencias);$i++)
                if($coincidencias[$i]->getIdentificacion() == $fila[0]){
                    $cliente = new ClienteAfiliado;
                    $cliente->setIdCliente($fila[1]);
                    $cliente->setTipoAfiliacion($fila[2]);
                    $cliente->setAfiliacionActiva($fila[3]);
                    $cliente->setFechaAfiliacion($fila[4]);
                    $tipoUsuarios = $coincidencias[$i]->getTipoUsuarios();
                    $tipoUsuarios[1] = $cliente;
                    $coincidencias[$i]->setTipoUsuarios($tipoUsuarios);
                    break;
                }
        }
        return $coincidencias;
    }
    
    public function fetchVendedor($coincidencias,$arrayQuery){
        while($fila = mysql_fetch_array($arrayQuery)){
            for($i=0;$i<count($coincidencias);$i++)
                if($coincidencias[$i]->getIdentificacion() == $fila[1]){
                    $vendedor = new Vendedor;
                    $vendedor->setIdVendedor($fila[0]);
                    $tipoUsuarios = $coincidencias[$i]->getTipoUsuarios();
                    $tipoUsuarios[0] = $vendedor;
                    $coincidencias[$i]->setTipoUsuarios($tipoUsuarios);
                    break;
                }
        }
        return $coincidencias;
    }
    
    public function eliminarNoCoincidentes($coincidencias){
        if($this->manejable->getTipoUsuarios()!=null){
            for($i=0;$i<count($coincidencias);$i++){
                for($j=0;$j<count($coincidencias[$i]->getTipoUsuarios());$j++){
                    for($k=0;$k<count($this->manejable->getTipoUsuarios());$k++){
                        if(!($coincidencias[$i]->getTipoUsuarios()[$j] instanceof 
                           $this->manejable->getTipoUsuarios[$k])){
                           for($w=$i;$w<count($coincidencias);$w++)
                               $coincidencias[$w] = $coincidencias[$w+1];
                           unset($coincidencias[count($coincidencias)-1]);
                           $i--;
                        }
                    }
                }
            }
        }
        return $coincidencias;
    }
}
?>