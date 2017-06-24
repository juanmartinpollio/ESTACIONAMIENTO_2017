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
                <script>
        
                function redireccionarListaVehiculos()
                {
                    window.location.href = "listadoDeVehiculos.php";
                }

                function redireccionarAltaVehiculos()
                {
                    window.location.href = "registrarVehiculo.php";
                }

                function redireccionarRetirarVehiculos()
                {
                    window.location.href = "retirarVehiculo.php";
                }

                </script>
            </head>
            <body>
                <h2>Menú del empleado</h2>
                Sesión inciada como: '.$_SESSION["empleado"].'</br>
                <form action="menuAdministrador.php" method="POST">
                    <input type="button" name="registrarVehiculo" value="Registrar vehículo" onclick="redireccionarAltaVehiculos()">
                    </br>
                    <input type="button" value="Historial de vehículos" onclick="redireccionarListaVehiculos()">
                    </br>
                    <input type="button" value="Retirar vehículos" onclick="redireccionarRetirarVehiculos()">
                    </br>
                    </br>
                    <input type="button" value="Desloguearse" onclick="cerrarSesionEmpleado()">
                </form>
            </body>
            </html>';
}
else
{
    header("Location:index.php");
}


?>