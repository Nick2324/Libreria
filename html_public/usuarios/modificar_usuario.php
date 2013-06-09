<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="../manejador_cookies/cookies.js"></script>
        <script src="../generador/generadorElementosHTML.js"></script>
        <script src="../generador/generador_campos_us_cambio.js"></script>
        <title>Modificar usuario</title>
    </head>
    <body onload="generarCamposUsCambio()">
        <div id="header">
            <h1>Modificar usuario</h1>
        </div>
        <div id="menu">
            <form id="form_usuarios" action="../../controlador/resolucion_peticiones.php" method="post">
                <input type="submit" value="Modificar usuario"/>
                <table id="usuario_cambio" border="1">
                    <tr>
                        <th>Atributos</th>
                        <th>Actual</th>
                        <th>Nuevo</th>
                    </tr>
                    <tr>
                        <th>Identificación</th>
                        <th></th>
                        <th><input type="number" name="identificacion" readonly/></th>
                    </tr>
                    <tr>
                        <th>Nombre</th>
                        <th></th>
                        <th><input type="text" name="nombre" placeholder="Nombre"/></th>
                    </tr>
                    <tr>
                        <th>Correo electrónico</th>
                        <th></th>
                        <th><input type="email" name="correoElectronico" placeholder="xxxx@yyy.zz"/></th>
                    </tr>
                    <tr>
                        <th>Dirección</th>
                        <th></th>
                        <th><input type="text" name="direccion" placeholder="Dirección residencia"/></th>
                    </tr>
                    <tr>
                        <th>Teléfono</th>
                        <th></th>
                        <th><input type="number" name="telefono" placeholder="Teléfono"/></th>
                    </tr>
                    <tr>
                        <th>Usuario activo/inactivo</th>
                        <th></th>
                        <th>
                            <select name="activo">
                                <option>Seleccion</option>
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </th>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
