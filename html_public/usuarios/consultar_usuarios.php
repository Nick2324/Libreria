<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="../generador/generador.js"></script>
        <script src="../generador/generador_campos_usuarios.js"></script>
        <title>Consultar usuarios</title>
    </head>
    <body>
        <div id="header">
            <h1>Consultar usuarios</h1>
        </div>
        <div id="menu">
            <form id="form_usuarios" action="../../controlador/resolucion_peticiones.php" method="post">
                <input type="submit" value="Enviar consulta"/>
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
                <input type="tel" name="telefono" placeholder="Teléfono"/>
                <!--<p>Tipo de perfil</p>
                <select id="tipo_perfil" onchange="generarCampos(this)">
                    <option value="no_seleccionado">Selección</option>
                    <optgroup label="Clientes">
                        <option value="cliente">Cliente</option>
                        <option value="cliente_afiliado">Cliente afiliado</option>
                    </optgroup>
                    <optgroup label="Tienda">
                        <option value="administrador">Admininstrador</option>
                        <option value="vendedor">Vendedor</option>
                    </optgroup>-->
                </select>
            </form>
        </div>
    </body>
</html>
