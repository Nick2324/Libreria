<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="../manejador_cookies/cookies.js"></script>
        <script src="../generador/generadorElementosHTML.js"></script>
        <script src="../generador/generador_campos_pr_cambio.js"></script>
        <title>Modificando producto</title>
    </head>
    <body onload="generarCamposPrCambio()">
        <div id="header">
            <h1>Modificando producto</h1>
        </div>
        <div id="menu">
            <form action="../../controlador/resolucion_peticiones.php" method="post">
                <input type="submit" value="Modificar"/>
                <table id="producto_cambio" border="1">
                    <tbody>
                        <tr>
                            <th>Campo</th>
                            <th>Actual</th>
                            <th>A cambiar</th>
                        </tr>
                        <tr>
                            <th>Id</th>
                            <th></th>
                            <th>
                                <input type="number" name="id" readonly/>
                            </th>
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
                                <textarea rows="10" cols="35" name="descripcion"></textarea>
                            </th>
                        </tr>
                        <tr>
                            <th>Idioma</th>
                            <th></th>
                            <th>
                                <select name="idioma">
                                    <option value="Seleccion">Seleccion</option>
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
                                    <option value="Seleccion">Seleccion</option>
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
                                    <option value="Seleccion">Seleccion</option>
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
                                    <option value="Seleccion">Seleccion</option>
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
                                <input type="number" name="prestado" readonly/>
                            </th>
                        </tr>
                    </body>
                </table>
            </form>
        </div>
    </body>
</html>
