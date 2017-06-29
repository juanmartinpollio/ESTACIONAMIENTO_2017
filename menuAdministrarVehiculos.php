<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TP Estacionamiento - Administración de Vehículos</title>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="funciones.js"></script>
    <link href="estilos/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body style="background-color:#87FACB;">
    <header>
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="container fluid">
                <div class="navbar-header">
                </div>
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Menú principal</a></li>

                        <?php

                        require "clases/Empleado.php";
                        session_start(); 
                        $arrayDeEmpleados = [];
                        $arrayDeEmpleados = Empleado::TraerTodosLosEmpleadosBD();

                        foreach ($arrayDeEmpleados as $item) 
                        {
                            if($item->GetUsuario() == $_SESSION["empleado"])
                            {
                                if($item->GetAdministrador() == 0)
                                {
                                    echo '<li><a href="menuAdministrarEmpleados.php">Empleados</a></li>
                                        <li class="active"><a href="menuAdministrarVehiculos.php">Vehículos</a></li>
                                        <li><a href="listadoDeEmpleados.php">Historial de empleados</a></li>
                                        <li><a href="listadoDeVehiculos.php">Historial de vehículos</a></li>';
                                }
                                else
                                {
                                    echo '<li class="active"><a href="menuAdministrarVehiculos.php">Vehículos</a></li>';
                                }
                            }
                        }


                        

                        ?>

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php 

                                                                                        echo $_SESSION["empleado"]; 
                                                                                        $arrayDeEmpleados = [];
                                                                                        $arrayDeEmpleados = Empleado::TraerTodosLosEmpleadosBD();

                                                                                        foreach ($arrayDeEmpleados as $item) 
                                                                                        {
                                                                                            if($item->GetUsuario() == $_SESSION["empleado"])
                                                                                            {
                                                                                                if($item->GetAdministrador() == 0)
                                                                                                {
                                                                                                    echo " (Administrador)";
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    echo " (Empleado)";
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                        ?></a></li>
                    </ul>
            </div>
        </nav>
    </header>
    <div class="form-group text-center">
    <font color="black"><h2 style="background-color:white;">Administrar vehículos</h2></font>
    <form action="menuAdministrarVehiculos.php" method="POST">
    <div class="btn-group-vertical">
        <input class="btn btn-default" type="submit" name="registrarAuto" value="Registrar auto">
        <input class="btn btn-default" type="submit" name="retirarAuto" value="Retirar auto">
        <input class="btn btn-default" type="submit" name="listadoDeCocheras" value="Listado de cocheras">
        </br>
        </br>
    </div>
    </form>
    <a href="index.php" class="btn btn-primary">Volver al menú principal</a>
    </div>
</body>
</html>

<?php

if(isset($_POST["registrarAuto"]))
{
    header("Location:registrarVehiculo.php");
}

if(isset($_POST["retirarAuto"]))
{
    header("Location:retirarVehiculo.php");
}

if(isset($_POST["listadoDeCocheras"]))
{
    header("Location:listadoDeCocheras.php");
}

?>