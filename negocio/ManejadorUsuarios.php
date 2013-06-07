<?php

namespace Manejadores;

require_once ('Usuario.php');
require_once ('Manejador.php');

use Usuarios\Usuario;
use Usuarios\Cliente;
use Usuarios\ClienteAfiliado;
use Usuarios\Trabajador;
use Manejadores;

class ManejadorUsuarios extends Manejador{
    
    function __construct(){}

    function __destruct(){}

    public function actualizarUsuario(){}

    public function afiliarCliente(){}

    public function borrarUsuario(){
        $this->abrirConexion();
        
        $this->cerrarConexion();
    }

    public function buscarUsuario(){
        $arrayBusqueda = array();
        $this->abrirConexion();
        $this->cerrarConexion();
    }

    public function construirManejable($partes){
        $this->manejable = new Usuario;
        $this->manejable->setIdentificacion($partes['identificacion']);
        $this->manejable->setNombre($partes['nombre']);
        $this->manejable->setCorreo($partes['correoElectronico']);
        $this->manejable->setTelefono($partes['telefono']);
        $this->manejable->setDireccion($partes['direccion']);
    }

    public function construirManejableCambio($partes){
        $this->manejableCambio = new Usuario;
        $this->manejableCambio->setIdentificacion($partes['identificacion_cambio']);
        $this->manejableCambio->setNombre($partes['nombre_cambio']);
        $this->manejableCambio->setCorreo($partes['correoElectronico_cambio']);
        $this->manejableCambio->setTelefono($partes['telefono_cambio']);
        $this->manejableCambio->setDireccion($partes['direccion_cambio']);
    }

    public function crearUsuario(){
        $this->abrirConexion();
        if($this->manejable->getIdentificacion()!=null &&
           $this->manejable->getNombre()!=null &&
           $this->manejable->getCorreo()!=null &&
           $this->manejable->getTelefono()!=null &&
           $this->manejable->getDireccion()!=null){
            $query_usuario = "INSERT INTO `usuario` (`k_id_usuario`,`n_nombre`,`n_correo`,`n_direccion`,`o_telefono`)
                VALUES ('".$this->manejable->getIdentificacion()."','".$this->manejable->getNombre()."',
                    '".$this->manejable->getCorreo()."','".$this->manejable->getDireccion()."',
                    '".$this->manejable->getTelefono()."')";
            $query = mysql_query($query_usuario);
            $this->cerrarConexion();
            echo $query_usuario;
            $this->crearTodosLosPerfiles();
            return $query;
        }
        return false;
    }
    
    public function crearTodosLosPerfiles(){
        $query_cliente = "INSERT INTO `cliente`(`k_id_cliente`, `k_id_usuario`)
            VALUES 
            (".($this->generarId("cliente")+1).",
             ".$this->manejable->getIdentificacion().")";
        $query_cliente_afiliado = "INSERT INTO `cliente_afiliado`
            (`k_id_cliente`, `i_tipo_afiliacion`, 
            `i_estado_afiliacion`, `f_afiliacion`) 
            VALUES 
            (".$this->manejable->getIdentificacion().",1,'a',CURDATE())";
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
}
?>