<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Crear producto</title>
        <script src="../generador/generador.js"></script>
        <script src="../generador/generador_campos_productos.js"></script>
    </head>
    <body>
        <div id="head">
            <h1>Crear producto</h1>
        </div>
        <div id="menu">
            <form id="form_productos" action="../../controlador/resolucion_peticiones.php" method="post">
                <input type="submit" value="Crear Producto"/>
                <a href="gestion_productos.php">
                    <input type="button" value="Volver"/>
                </a>
                <p>Nombre</p>
                <input type="text" name="nombre" placeholder="Nombre">
                <p>Descripción</p>
                <textarea rows="10" cols="35" name="descripcion"></textarea>
                <p>Idioma</p>
                <select name="idioma">
                    <option value="Español">Español</option>
                    <option value="Ingles">Ingles</option>
                    <option value="Frances">Frances</option>
                </select>
                <p>Formato</p>
                <select name="formato">
                    <option value="CD">CD</option>
                    <option value="DVD">DVD</option>
                </select>
                <p>Fecha de edición</p>
                <input type="date" name="fecha_edicion"/>
                <p>Precio</p>
                <input type="number" name="precio" placeholder="Precio"/>
                <p>Transaccionalidad</p>
                <select name="transaccionalidad">
                    <option value="Venta">Venta</option>
                    <option value="Prestamo">Préstamo</option>
                </select>
                <p>Inventario</p>
                <select name="inventario">
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
                <p>No. de ejemplares en inventario</p>
                <input type="number" name="stock" placeholder="Stock"/>
                <p>Tipo</p>
                <select id="tipo_producto" name="tipo_producto" onchange="generadorCampos(this)">
                    <option value="no_seleccionado">Selección</option>
                    <option value="libro">Libro</option>
                    <option value="video">Video</option>
                </select>
            </form>
        </div>
    </body>
</html>
