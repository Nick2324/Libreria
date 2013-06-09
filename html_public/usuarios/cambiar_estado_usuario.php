<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="../manejador_cookies/cookies.js"></script>
        <script src="../manejador_cookies/carga_cookies_cambio.js"></script>
        <title>Cambiando estado producto</title>
    </head>
    <body onload="cargarElementoCambio('usuario')">
        <div id="header">
            <h1>Cambiar estado de usuario</h1>
        </div>
        <div id="menu">
            <form action="../../controlador/resolucion_peticiones.php" method="post">
                <p>¿Está segur de cambiar el estado del producto?</p><br>
                <p>Identificacion usuario</p>
                <input type="text" name="identificacion" readonly/><br>
                <p>Estado usuario</p>
                <input type="text" name="activo" readonly/><br>
                <a href="resultado_consulta_usuarios.php">
                    <input type="button" value="No" onclick="eliminarElementoCambio('usuario')"/>
                </a>
                <input type="submit" value="Si"/>
            </form>
        </div>
    </body>
</html>
