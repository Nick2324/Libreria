<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Añadir producto</title>
    </head>
    <body>
        <div id="header">
            <h1>Añadir producto a transacción</h1>
        </div>
        <div id="menu">
                <form action="../../controlador/resolucion_peticiones.php" method="post">
                <p>Ingrese el id del producto a añadir</p>
                <input type="number" name="id" placeholder="Id de producto"/>
                <p>Ingrese la cantidad de copias que desea del producto</p>
                <input type="number" name="cantidad_producto" placeholder="Cantidad de copias"/>
                <input type="submit" value="Añadir producto"/>
            </form>
        </div>
    </body>
</html>
