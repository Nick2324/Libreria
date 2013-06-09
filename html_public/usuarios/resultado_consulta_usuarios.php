<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="../manejador_cookies/cookies.js"></script>
        <script src="../generador/generadorElementosHTML"></script>
        <script src="../manejador_cookies/carga_cookies_cambio.js"></script>
        <script src="../manejador_cookies/cargar_consulta_usuarios.js"></script> 
        <script src="../manejador_cookies/eliminar_consulta_usuarios.js"></script>
        <title>Consultando usuarios</title>
    </head>
    <body onload="cargarConsultaUsuarios()">
        <div id="header">
            <h1>Resultado de la consulta de usuarios</h1>
        </div>
        <div id="menu">
            <table id="usuarios" border="1">
                <thead>
                    <tr>
                        <th>Identificacion</th>
                        <th>Nombre</th>
                        <th>Perfiles asociados</th>
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
