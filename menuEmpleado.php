<?php

session_start();

if(isset($_SESSION["empleado"]))
{
    echo '<!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>TP Estacionamiento - Menú Empleado</title>
                <script type="text/javascript" src="jquery.js"></script>
                <script type="text/javascript" src="funciones.js"></script>
            </head>
            <body>
                <h2>Menú del empleado</h2>
                Sesión inciada como: '.$_SESSION["empleado"].'</br>
                <input type="button" value="Registrar vehículo">
                </br>
                <input type="button" value="Listado de vehículos">
                </br>
                <input type="button" value="Retirar vehículos">
                </br>
                </br>
                <input type="button" value="Desloguearse" onclick="cerrarSesionEmpleado()">
            </body>
            </html>';
}
else
{
    header("Location:index.php");
}


?>