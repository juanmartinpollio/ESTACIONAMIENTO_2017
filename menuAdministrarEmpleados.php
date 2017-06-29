<?php

require "clases/Empleado.php";

session_start();

if(isset($_SESSION["empleado"]))
{
    $arrayDeEmpleados = [];
	$arrayDeEmpleados = Empleado::TraerTodosLosEmpleadosBD();
    $flag = 0;

	foreach ($arrayDeEmpleados as $item) 
	{
		if($item->GetUsuario() == $_SESSION["empleado"])
		{
                if($item->GetAdministrador() == 0)
                {
                    echo '<!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>TP Estacionamiento - Menú para administrar empleados</title>
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
                                    <li><a href="menuAdministrador.php">Menú principal</a></li>
                                    <li class="active"><a href="menuAdministrarEmpleados.php">Empleados</a></li>
                                    <li><a href="menuAdministrarVehiculos.php">Vehículos</a></li>
                                    <li><a href="listadoDeEmpleados.php">Historial de empleados</a></li>
                                    <li><a href="listadoDeVehiculos.php">Historial de vehículos</a></li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> '.$_SESSION["empleado"].' (Administrador)</a></li>
                                </ul>
                        </div>
                    </nav>
                    </header>
                    <div class="form-group text-center">
                    <font color="black"><h2 style="background-color:white;">Administrar empleados</h2></font>
                    <form action="menuAdministrarEmpleados.php" method="POST">
                    <div class="btn-group-vertical">
                        <input class="btn btn-default" type="submit" name="alta" value="Agregar nuevo empleado">
                        <input class="btn btn-default" type="submit" name="suspender" value="Suspender empleado">
                        <input class="btn btn-default" type="submit" name="habilitar" value="Habilitar empleado">
                        <input class="btn btn-default" type="submit" name="baja" value="Eliminar empleado">
                        </br>
                        </br>
                    </div>
                    </form>
                    <a href="menuAdministrador.php" class="btn btn-primary">Volver al menú del administrador</a>
                    </div>
                </body>
                </html>';

                if(isset($_POST["alta"]))
                {
                    header("Location:altaEmpleado.php");
                }

                if(isset($_POST["suspender"]))
                {
                    header("Location:suspenderEmpleado.php");
                }

                if(isset($_POST["habilitar"]))
                {
                    header("Location:habilitarEmpleado.php");
                }

                if(isset($_POST["baja"]))
                {
                    header("Location:eliminarEmpleado.php");
                }
			}
			else
			{
				header("Location:menuEmpleado.php");
			}
		}
	}
}
else
{
    header("Location:index.php");
}

?>