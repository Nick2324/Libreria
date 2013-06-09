<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Condonar prestamo</title>
    </head>
    <body>
        <div id="header">
            <h1>Condonar prestamo</h1>
        </div>
        <div id="menu">
            <form action="../../controlador/resolucion_peticiones.php" method="post">
                <p>Id de la transaccion</p>
                <input type="number" name="id_transaccion" placeholder="Id de transacción"/>
                <p>Id del cliente</p>
                <input type="number" name="id_cliente" placeholder="Id de transacción"/>
                <p>Id del producto</p>
                <input type="number" name="id_producto" placeholder="Id de transacción"/>
                <input type="submit" value="Enviar"/>
            </form>
        </div>
    </body>
</html>
