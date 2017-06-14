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
        <form action="menuAdministrador.php" method="POST">
            <h2>Menú del administrador</h2>
            Sesión inciada como: '.$_SESSION["empleado"].'</br>
            <input type="submit" name="registrarVehiculo" value="Registrar vehículo">
            </br>
            <input type="submit" value="Listado de vehículos">
            </br>
            <input type="submit" value="Retirar vehículos">
            </br>
            <input type="button" value="Administrar personal" onclick="redireccionarAdministrarEmpleados()">
            </br>
            </br>
            <input type="button" value="Desloguearse" onclick="cerrarSesionEmpleado()">
        </form>
    </body>
    </html>';

    if(isset($_POST["registrarVehiculo"]))
    {
        header("Location:registrarVehiculo.php");
    }

}
else
{
    header("Location:index.php");
}

?>
