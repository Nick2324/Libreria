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
            </form>
        </div>
    </body>
</html>
