<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Realizar transaccion</title>
        <script src="../manejador_cookies/cookies.js"></script>
        <script src="prueba.js"></script>
        <script src="../generador/generadorElementosHTML.js"></script>
        <script src="../manejador_cookies/guardar_transaccion.js"></script>
        <script src="../manejador_cookies/cargar_transaccion.js"></script>
        <script src="../manejador_cookies/eliminar_transaccion.js"></script>
    </head>
    <body onload="cargarEstadoTransaccion()">
        <div id="head">
            <h1>Realizar transacción</h1>
        </div>
        <div id="menu">
            <form id="form_rtransaccion" action="../../controlador/resolucion_peticiones.php" method="post">
                <p>Sucursal</p>
                <select name="sucursal">
                    <option value="Chapinero">Chapinero</option>
                    <option value="AV Rojas">AV Rojas</option>
                    <option value="Suba">Suba</option>
                    <option value="Autonorte">Autonorte</option>
                </select>
                <br>
                <br>
                <table id="cliente" border="1">
                    <tr>
                        <th>Nombre</th>
                    </tr>
                    <tr>
                        <th>Identificación</th>
                    </tr>
                    <tr>
                        <th>Correo electrónico</th>
                    </tr>
                    <tr>
                        <th>Teléfono</th>
                    </tr>
                    <tr>
                        <th>Dirección</th>
                    </tr>
                    <tr>
                        <th>Tipo de afiliación</th>
                    </tr>
                </table>
                <br>
                <a href="aniadir_cliente.php">
                    <input type="button" value="Cambiar cliente" onclick="guardarEstadoTransaccion()"/>
                </a>
                <p>Forma de pago</p>
                <select id="forma_pago" name="forma_pago">
                    <option value="efectivo">Efectivo</option>
                    <option value="credito">Tarjeta crédito</option>
                </select>
                <br>
                <br>
                <div id="contenedor_productos">
                    <table id="productos" border="1">
                        <tr>
                            <th>Id producto</th>
                            <th>Nombre de producto</th>
                            <th>Tipo de producto</th>
                            <th>Transaccionalidad</th>
                            <th>Unidades</th>
                            <th>Precio total</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>     
                    </table>
                    <br>
                    <a href="aniadir_producto.php">
                        <input type="button" value="Adicionar producto" onclick="guardarEstadoTransaccion()"/>
                    </a>
                </div>
                <br>
                <input type="submit" value="Enviar" onclick="eliminarDatosTransaccion()"/>
            </form>
        </div>
    </body>
</html>
