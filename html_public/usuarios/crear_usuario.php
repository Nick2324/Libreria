<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Crear usuario</title>
    </head>
    <body>
        <div id="header">
            <h1>Crear usuario</h1>
        </div>
        <div id="menu">
            <form id="form_usuarios" action="../../controlador/resolucion_peticiones.php" method="post">
                <input type="submit" value="Crear usuario"/>
                <a href="gestion_usuarios.php">
                    <input type="button" value="Volver"/>
                </a>
                <p>Identificación</p>
                <input type="number" name="identificacion" placeholder="Identificación"/>
                <p>Nombre</p>
                <input type="text" name="nombre" placeholder="Nombre"/>
                <p>Correo electrónico</p>
                <input type="email" name="correoElectronico" placeholder="xxxx@yyy.zz"/>
                <p>Dirección</p>
                <input type="text" name="direccion" placeholder="Dirección residencia"/>
                <p>Teléfono</p>
                <input type="number" name="telefono" placeholder="Teléfono"/>
                <p>Usuario activo/inactivo</p>
                <select name="activo">
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </form>
        </div>
    </body>
</html>
