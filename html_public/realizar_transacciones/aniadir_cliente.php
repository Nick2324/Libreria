<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Añadir cliente</title>
    </head>
    <body>
        <div id="header">
            <h1>Añadir nuevo cliente a transacción</h1>
        </div>
        <div id="menu">
            <form action="../../controlador/resolucion_peticiones.php" method="post">
                <p>Ingrese la identificación del cliente</p>
                <input type="number" name="identificacion" placeholder="Identificación"/>
                <input type="hidden" name="tipo_usuario" value="cliente"/>
                <input type="submit" value="Añadir cliente"/>
            </form>
            <a href="realizar_transaccion.php">
                <input type="button" value="Volver"/>
            </a>
        </div>
    </body>
</html>
