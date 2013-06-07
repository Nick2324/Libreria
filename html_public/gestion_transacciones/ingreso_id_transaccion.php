<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Id transaccion</title>
    </head>
    <body>
        <div id="header">
            <h1>Ingreso de id</h1>
        </div>
        <div id="menu">
            <form action="../../controlador/resolucion_peticiones.php" method="post">
                <p>Para obtener descriptivo de transaccion ingrese el id de la factura</p>
                <input type="number" name="id_transaccion" placeholder="Id de transacción"/>
                <input type="submit" value="Enviar"/>
            </form>
        </div>
    </body>
</html>
