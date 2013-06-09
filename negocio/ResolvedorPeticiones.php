<?php

namespace Peticiones;

require_once ('../negocio/RegistradorTransacciones.php');
require_once ('../negocio/ManejadorProductos.php');
require_once ('../negocio/ManejadorUsuarios.php');
require_once ('../negocio/ManejadorPrestamos.php');

use Manejadores\RegistradorTransacciones;
use Manejadores\ManejadorProductos;
use Manejadores\ManejadorUsuarios;
use Manejadores\ManejadorPrestamos;

class ResolvedorPeticiones{
    
    private $manejadorUsuarios;
    private $manejadorPrestamos;
    private $manejadorProductos;
    private $registradorTransacciones;
    
    function __construct(){}

    function __destruct(){}
    
    public function construirMensaje($mensaje,$redireccion){
        $resultado = "<script>";
        if($mensaje!=null)
            $resultado = $resultado."alert('".$mensaje."');";
        if($redireccion!=null)
            $resultado = $resultado."location.href='".$redireccion."';";
        return $resultado."</script>";
    }
    
    public function resolverPeticion(){
        if(substr_count($_SERVER['HTTP_REFERER'],"realizar_transaccion.php") != 0){
        $this->registradorTransacciones = new RegistradorTransacciones;
        $this->registradorTransacciones->construirManejable($_POST);
        if($this->registradorTransacciones->registrarTransaccion())
            return $this->construirMensaje ("Transaccion realizada con exito","http://localhost/Libreria/html_public/realizar_transacciones/realizar_transaccion.php");
        else
            return $this->construirMensaje ("Transaccion no ha podido realizarse con exito","http://localhost/Libreria/html_public/realizar_transacciones/realizar_transaccion.php");
        }else if(substr_count($_SERVER['HTTP_REFERER'],"aniadir_producto.php") != 0){
            $this->manejadorProductos = new ManejadorProductos;
            $this->manejadorProductos->construirManejable($_POST);
            $productoNuevo = $this->manejadorProductos->buscarProducto()[0];
            if($productoNuevo != null){
                $cantidadValida = true;
                if($_POST['cantidad_producto']>0){
                    if($productoNuevo->getTransaccionalidad()=="Prestamo"){
                        if($productoNuevo->getStock()-$productoNuevo->getPrestado()<$_POST['cantidad_producto'])
                            $cantidadValida = false;
                    }else if($productoNuevo->getTransaccionalidad()=="Venta")
                        if($productoNuevo->getStock()<$_POST['cantidad_producto'])
                            $cantidadValida = false;
                }else
                    $cantidadValida = false;
                if($cantidadValida){
                    $productos = json_decode($_COOKIE['productos']);
                    $encontrado = false;
                    if($productos==null)
                        $productos=array();
                    for($i=0;$i<count($productos);$i++)
                        if($productos[$i]->id == $productoNuevo->getId()){
                            $encontrado=true;
                            break;
                        }
                    if(!$encontrado){
                        $productos = array_merge($productos,array('0'=>$productoNuevo));
                        $cantidad = array_merge(json_decode($_COOKIE['cantidad']),array('0'=>$_POST['cantidad_producto']));
                        setcookie("productos",json_encode($productos),time()+13600*24, "/");
                        setcookie("cantidad",json_encode($cantidad),time()+13600*24, "/");
                        return $this->construirMensaje("Producto adicionado con exito","http://localhost/Libreria/html_public/realizar_transacciones/realizar_transaccion.php");
                    }else
                        return $this->construirMensaje ("Producto ya se encuentra en transaccion","http://localhost/Libreria/html_public/realizar_transacciones/realizar_transaccion.php");
                }
            }else
                return $this->construirMensaje('No se encuentra producto asociado al id proporcionado',"http://localhost/Libreria/html_public/realizar_transacciones/realizar_transaccion.php");
        }else if(substr_count($_SERVER['HTTP_REFERER'],"aniadir_cliente.php") != 0){
            $this->manejadorUsuarios = new ManejadorUsuarios;
            $this->manejadorUsuarios->construirManejable($_POST);
            $cliente = $this->manejadorUsuarios->buscarUsuario()[0];
            if($cliente != null && $cliente->getTipoUsuarios()[1]!=null){
                setcookie("cliente",json_encode($cliente),time()+13600*24, "/");
                return $this->construirMensaje('Cliente adicionado con exito',"http://localhost/Libreria/html_public/realizar_transacciones/realizar_transaccion.php");
            }else
                return $this->construirMensaje ('No se encuentra cliente con la identificacion proporcionada',"http://localhost/Libreria/html_public/realizar_transacciones/realizar_transaccion.php");
        }else if(substr_count($_SERVER['HTTP_REFERER'],"crear_producto.php") != 0){
            $this->manejadorProductos = new ManejadorProductos;
            $this->manejadorProductos->construirManejable($_POST);
            if($this->manejadorProductos->crearProducto())
                return $this->construirMensaje ('Producto creado con exito',"http://localhost/Libreria/html_public/productos/gestion_productos.php");
            else
                return $this->construirMensaje ('Producto no pudo ser creado',"http://localhost/Libreria/html_public/productos/gestion_productos.php");
        }else if(substr_count($_SERVER['HTTP_REFERER'],"consultar_productos.php") != 0){
            $this->manejadorProductos = new ManejadorProductos;
            $this->manejadorProductos->construirManejable($_POST);
            $buscado = $this->manejadorProductos->buscarProducto();
            setcookie("productos",  json_encode($buscado),time()+13600*24, "/");
            return $this->construirMensaje(null,'http://localhost/Libreria/html_public/productos/resultado_consulta_productos.php');
        }else if(substr_count($_SERVER['HTTP_REFERER'],"condonar_prestamo.php") != 0){
            $this->manejadorPrestamos = new ManejadorPrestamos;
            $this->manejadorPrestamos->construirManejable($_POST);
            if($this->manejadorPrestamos->condonarPrestamo())
                return $this->construirMensaje ("Prestamo eliminado con exito","http://localhost/Libreria/html_public/gestion_transacciones/gestion_transacciones.php");
            else
                return $this->construirMensaje ("Prestamo no pudo ser eliminado","http://localhost/Libreria/html_public/gestion_transacciones/gestion_transacciones.php");
        }else if(substr_count($_SERVER['HTTP_REFERER'],"crear_usuario.php") != 0){
            $this->manejadorUsuarios = new ManejadorUsuarios();
            $this->manejadorUsuarios->construirManejable($_POST);
            if($this->manejadorUsuarios->crearUsuario())
                return $this->construirMensaje ("Creado correctamente","http://localhost/Libreria/html_public/usuarios/gestion_usuarios.php");
            else
                return $this->construirMensaje ("No pudo ser creado","http://localhost/Libreria/html_public/usuarios/gestion_usuarios.php");
        }else if(substr_count($_SERVER['HTTP_REFERER'],"consultar_usuarios.php") != 0){
            $this->manejadorUsuarios = new ManejadorUsuarios();
            $this->manejadorUsuarios->construirManejable($_POST);
            $buscado = $this->manejadorUsuarios->buscarUsuario();
            setcookie("usuarios",  json_encode($buscado),time()+13600*24, "/");
            return $this->construirMensaje(null,'http://localhost/Libreria/html_public/usuarios/resultado_consulta_usuarios.php');
        }else if(substr_count($_SERVER['HTTP_REFERER'],"cambiar_estado_usuario.php") != 0){
            $this->manejadorUsuarios = new ManejadorUsuarios();
            $this->manejadorUsuarios->construirManejable($_POST);
            if($this->manejadorUsuarios->cambiarEstadoUsuario())
                return $this->construirMensaje ("Cambio realizado con exito","http://localhost/Libreria/html_public/usuarios/resultado_consulta_usuarios.php");
            else
                return $this->construirMensaje ("No se ha podido realizar el cambio","http://localhost/Libreria/html_public/usuarios/resultado_consulta_usuarios.php");
        }else if(substr_count($_SERVER['HTTP_REFERER'],"modificar_usuario.php") != 0){
            $this->manejadorUsuarios = new ManejadorUsuarios();
            $this->manejadorUsuarios->construirManejable($_POST);
            if($this->manejadorUsuarios->actualizarUsuario())
                return $this->construirMensaje ("Cambio realizado con exito","http://localhost/Libreria/html_public/usuarios/resultado_consulta_usuarios.php");
            else
                return $this->construirMensaje ("No se ha podido realizar el cambio","http://localhost/Libreria/html_public/usuarios/resultado_consulta_usuarios.php");
        }else if(substr_count($_SERVER['HTTP_REFERER'],"cambiar_estado_producto.php") != 0){
            $this->manejadorProductos = new ManejadorProductos;
            $this->manejadorProductos->construirManejable($_POST);
            if($this->manejadorProductos->cambiarEstadoProducto())
                return $this->construirMensaje ("Cambio realizado con exito","http://localhost/Libreria/html_public/productos/resultado_consulta_productos.php");
            else
                return $this->construirMensaje ("No se ha podido realizar el cambio","http://localhost/Libreria/html_public/productos/resultado_consulta_productos.php");
        }else if(substr_count($_SERVER['HTTP_REFERER'],"modificar_producto.php") != 0){
            $this->manejadorProductos = new ManejadorProductos;
            $this->manejadorProductos->construirManejable($_POST);
            if($this->manejadorProductos->actualizarProducto())
                return $this->construirMensaje ("Cambio realizado con exito","http://localhost/Libreria/html_public/productos/resultado_consulta_productos.php");
            else
                return $this->construirMensaje ("No se ha podido realizar el cambio","http://localhost/Libreria/html_public/productos/resultado_consulta_productos.php");
        }
    }
    
}
?>
