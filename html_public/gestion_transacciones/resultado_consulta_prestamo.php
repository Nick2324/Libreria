<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="../manejador_cookies/cookies.js"></script>
        <script src="../generador/generadorElementosHTML.js"></script>
        <script src="prueba.js"></script>
        <script src="../manejador_cookies/cargar_condonacion.js"></script>
        <script src="../manejador_cookies/eliminar_condonacion.js"></script>
        <title>Consulta condonacion</title>
    </head>
    <body onload="cargarCondonacion()">
        <div id="header">
            <h1>Resultado de la consulta de prestamos</h1>
        </div>
        <div id="menu">
            <h3>Descripcion de la transaccion</h3>
            <table id="descripcion_transaccion" border="1">
                <thead>
                    <tr>
                        <th>Id transaccion</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Identificacion</th>
                        <th>Vendedor</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <h3>Productos prestados en la transaccion</h3>
            <table id="productos_transaccion" border="1">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Formato</th>
                        <th>Idioma</th>
                        <th>Condonar</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </body>
</html>
