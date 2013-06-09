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
    use Productos\Video;
    use Productos\Libro;
    use Usuarios\Cliente;
    use Usuarios\ClienteAfiliado;
    use Usuarios\Trabajador;
    
    if(substr_count($_SERVER['HTTP_REFERER'],"realizar_transaccion.php") != 0){
        $manejadorTransacciones = new RegistradorTransacciones;
        $manejadorTransacciones->construirManejable($_POST);
        if($manejadorTransacciones->registrarTransaccion())
            echo "Transaccion realizada con exito!";
        else
            echo "Transaccion paila!!";
    }else if(substr_count($_SERVER['HTTP_REFERER'],"aniadir_producto.php") != 0){
        $manejadorProductos = new ManejadorProductos;
        $manejadorProductos->construirManejable();
        $productoNuevo = $manejadorProductos->getProducto();
        if($productoNuevo != null){
            if($_POST['cantidad_producto'] > 0 && $_POST['cantidad_producto'] <= $productoNuevo->getStock()){
                $tipo = null;
                if($productoNuevo instanceof Video)
                    $tipo = "Video";
                else if($productoNuevo instanceof Libro)
                    $tipo = 'Libro';
                $tipo = "libro";
                $valor = json_decode($_COOKIE['productos']);
                $valor[count($valor)] = json_decode('{"id":"'.$productoNuevo->getId().'","nombre":"'.$productoNuevo->getNombre().'","tipo":"'.$tipo.'","transaccionalidad":"'.$productoNuevo->getTransaccionalidad().'"}');
                setcookie("productos",json_encode($valor),time()+13600*24,"/");
                $valor = json_decode($_COOKIE['cantidad']);
                $valor[count($valor)] = $_POST['cantidad_producto'];
                setcookie("cantidad",json_encode($valor),time()+13600*24, "/");
                $valor = json_decode($_COOKIE['precioTotal']);
                $valor[count($valor)] = (int)$_POST['cantidad_producto']*$productoNuevo->getPrecio();
                setcookie("precioTotal",json_encode($valor),time()+13600*24, "/");
            }
        }else{
            echo 'no se encuentra producto asociado';
        }
    }else if(substr_count($_SERVER['HTTP_REFERER'],"aniadir_cliente.php") != 0){
        $manejadorUsuarios = new ManejadorUsuarios;
        $manejadorUsuarios->construirManejable();
        $cliente = $manejadorUsuarios->getManejable();
        if($cliente != null){
            $tipoAfiliacion = null;
            if($cliente instanceof ClienteAfiliado)
                $tipoAfiliacion = "Afiliado";
            else if($cliente instanceof Cliente)
                $tipoAfiliacion = "NN";
            $valor = json_decode($_COOKIE['cliente']);
            $valor->nombre = $cliente->getNombre();
            $valor->identificacion = $cliente->getIdentificacion();
            $valor->correoElectronico = $cliente->getCorreo();
            $valor->direccion = $cliente->getDireccion();
            $valor->telefono = $cliente->getTelefono();
            $valor->tipoAfiliacion = $tipoAfiliacion;
            setcookie("cliente",json_encode($valor),time()+13600*24, "/");
        }else{
            echo 'no se encuentra';
        }
        
    }else if(substr_count($_SERVER['HTTP_REFERER'],"crear_producto.php") != 0){
        $manejadorProductos = new ManejadorProductos;
        $manejadorProductos->construirManejable($_POST);
        if($manejadorProductos->crearProducto())
            echo 'producto creado con exito';
        else
            echo 'producto no pudo ser creado';
    }else if(substr_count($_SERVER['HTTP_REFERER'],"consultar_productos.php") != 0){
        $manejadorProductos = new ManejadorProductos;
        $manejadorProductos->construirManejable($_POST);
        $buscado = $manejadorProductos->buscarProducto();
    }else if(substr_count($_SERVER['HTTP_REFERER'],"condonar_prestamo.php") != 0){
        $manejadorPrestamos = new ManejadorPrestamos;
        $manejadorPrestamos->construirManejable($_POST);
        if($manejadorPrestamos->condonarPrestamo())
            echo "prestamo eliminado con exito";
        else
            echo "no pude con el prestamo ='(";
    }else if(substr_count($_SERVER['HTTP_REFERER'],"crear_usuario.php") != 0){
        $manejadorUsuarios = new ManejadorUsuarios();
        $manejadorUsuarios->construirManejable($_POST);
        if($manejadorUsuarios->crearUsuario())
            echo "Creado correctamente";
        else
            echo "No se pudo crear!";
    }else if(substr_count($_SERVER['HTTP_REFERER'],"consultar_usuarios.php") != 0){
        $manejadorUsuarios = new ManejadorUsuarios();
        $manejadorUsuarios->construirManejable($_POST);
        $manejadorUsuarios->buscarUsuario();
    }else if(substr_count($_SERVER['HTTP_REFERER'],"cambiar_estado_producto.php") != 0){
        $manejadorProductos = new ManejadorProductos;
        $manejadorProductos->construirManejable($_POST);
        if($manejadorProductos->cambiarEstadoProducto())
            echo "cambiado correctamente!!";
        else
            echo "no pudo ser cambiado =(";
    }else if(substr_count($_SERVER['HTTP_REFERER'],"modificar_producto.php") != 0){
        $manejadorProductos = new ManejadorProductos;
        $manejadorProductos->construirManejable($_POST);
        if($manejadorProductos->actualizarProducto())
            echo "se actualizo correctamente!!";
        else
            echo "No se actualizo ='(";
    }
?>
