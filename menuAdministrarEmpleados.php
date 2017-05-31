<?php

session_start();

if(isset($_SESSION["personal"]))
{
    echo '<!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Menú para administrar empleados</title>
                <script type="text/javascript" src="jquery.js"></script>
                <script type="text/javascript" src="funciones.js"></script>
            </head>
            <body>
                <h2>Administrar empleados</h2>
                <input type="button" value="Agregar nuevo empleado">
                </br>
                <input type="button" value="Suspender empleado">
                </br>
                <input type="button" value="Habilitar empleado">
                </br>
                <input type="button" value="Eliminar empleado">
            </body>
            </html>';
}
else
{
    header("Location:index.php");
}

?>