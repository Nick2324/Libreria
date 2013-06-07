<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Modificando producto</title>
        <script src="../manejador_cookies/cookies.js"></script>
        <script src="prueba_modificable.js"></script>
        <script src=""></script>
    </head>
    <body>
        <div id="header">
            <h1>Modificando producto</h1>
        </div>
        <div id="menu">
            <form action="../../controlador/resolucion_peticiones.php" method="post">
                <input type="submit" value="Modificar"/>
                <table id="producto_modificable" border="1">
                    <tbody>
                        <tr>
                            <th>Campo</th>
                            <th>Actual</th>
                            <th>A cambiar</th>
                        </tr>
                        <tr>
                            <th>Id</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>Nombre</th>
                            <th></th>
                            <th>
                                <input type="text" name="nombre">
                            </th>
                        </tr>
                        <tr>
                            <th>Descripcion</th>
                            <th></th>
                            <th>
                                <textarea rows="10" cols="35" name="descripcion_modificable"></textarea>
                            </th>
                        </tr>
                        <tr>
                            <th>Idioma</th>
                            <th></th>
                            <th>
                                <select name="idioma">
                                    <option value="Espanol">Español</option>
                                    <option value="Ingles">Ingles</option>
                                    <option value="Frances">Frances</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>Formato</th>
                            <th></th>
                            <th>
                                <select id="formato" name="formato">
                                    <option value="CD">CD</option>
                                    <option value="DVD">DVD</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>Transaccionalidad</th>
                            <th></th>
                            <th>
                                <select name="transaccionalidad">
                                    <option value="Venta">Venta</option>
                                    <option value="Prestamo">Prestamo</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>Inventario</th>
                            <th></th>
                            <th>
                                <select name="inventario">
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>Fecha de edicion</th>
                            <th></th>
                            <th>
                                <input type="date" name="fecha_edicion"/>
                            </th>
                        </tr>
                        <tr>
                            <th>Stock</th>
                            <th></th>
                            <th>
                                <input type="number" name="stock"/>
                            </th>
                        </tr>
                        <tr>
                            <th>Precio</th>
                            <th></th>
                            <th>
                                <input type="number" name="precio"/>
                            </th>
                        </tr>
                        <tr>
                            <th>Prestado</th>
                            <th></th>
                            <th>
                                <input type="number" name="prestado"/>
                            </th>
                        </tr>
                    </body>
                </table>
            </form>
        </div>
    </body>
</html>
