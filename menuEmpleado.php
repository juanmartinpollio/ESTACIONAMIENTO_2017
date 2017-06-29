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
        <title>TP Estacionamiento - Menú del Empleado</title>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="funciones.js"></script>
        <link href="estilos/css/bootstrap.min.css" rel="stylesheet" media="screen">
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
    <body background="http://aktivdv.ru/uploads/sale/993631b1b5024877198f35f1aa817d26.jpg">
        <header>
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="container fluid">
                <div class="navbar-header">
                </div>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="menuAdministrador.php">Menú principal</a></li>
                        <li><a href="menuAdministrarVehiculos.php">Vehículos</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> '.$_SESSION["empleado"].' (Empleado)</a></li>
                    </ul>
            </div>
        </nav>
        </header>
        <div class="form-group text-center">
            <form action="menuEmpleado.php" method="POST">
            <h2 style="background-color:white;">Menú del empleado</h2>
            </br>
            </br>
            <input type="button" class="btn btn-danger" value="Desloguearse" onclick="cerrarSesionEmpleado()">
        </form>
        </div>
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
