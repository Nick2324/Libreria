<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="../manejador_cookies/cookies.js"></script>
        <script src="../generador/generadorElementosHTML.js"></script>
        <script src="prueba.js"></script>
        <script src="../manejador_cookies/cargar_consulta_productos.js"></script>
        <script src="../manejador_cookies/eliminar_consulta_productos.js"></script>
        <script src="../manejador_cookies/carga_cookies_cambio.js"></script>
        <title>Consultando productos</title>
    </head>
    <body onload="cargarEstadoConsultaProductos()">
        <div id="header">
            <h1>Resultado de la consulta de productos</h1>
        </div>
        <div id="menu">
            <table id="productos" border="1">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Formato</th>
                        <th>Idioma</th>
                        <th>Transaccionalidad</th>
                        <th>Inventario</th>
                        <th>Modificar</th>
                        <th>Cambiar estado</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </body>
</html>
