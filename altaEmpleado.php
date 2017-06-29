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
                            <title>TP Estacionamiento - Agregar Empleado</title>
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
                                                <li><a href="#"><span class="glyphicon glyphicon-user"></span> '.$_SESSION["empleado"]. '  (Administrador)</a></li>
                                            </ul>
                                    </div>
                                </nav>
                            </header>
                            <div class="form-group text-center">
                            <form action="altaEmpleado.php" method="POST">
                                <font color="black"><h2 style="background-color:white;">Registro del nuevo empleado</h2></font>
                                <font size="4px" color="black">Usuario:</font>
                                </br>
                                <input type="text" name="usuario" required>
                                </br>
                                <font size="4px" color="black">Nombre:</font>
                                </br>
                                <input type="text" name="nombre" required>
                                </br>
                                <font size="4px" color="black">Apellido:</font>
                                </br>
                                <input type="text" name="apellido" required>
                                </br>
                                <font size="4px" color="black">Contraseña:</font>
                                </br>
                                <input type="password" name="password" required>
                                </br>
                                <font size="4px" color="black">Turno:</font>
                                </br>
                                <select name="turno" id="turno" required>
                                <option value="0">Mañana</option>
                                <option value="1">Noche</option>
                                <option value="2">Tarde</option>
                                </select>
                                </br>
                                <font size="4px" color="black">Condicion:</font>
                                </br>
                                <select name="condicion" required> 
                                <option value="0">Habilitado</option>
                                <option value="1">Suspendido</option>
                                </select>
                                </br>
                                <font size="4px" color="black">Administrador:</font>
                                </br>
                                <select name="administrador" required>
                                <option value="0">Activado</option>
                                <option value="1">Desactivado</option>
                                </select>
                                </br>
                                </br>
                                <input type="submit" class="btn btn-success" name="agregarEmpleado" value="Agregar empleado">
                            </form>
                            </br>
                            </br>
                            <a href="menuAdministrarEmpleados.php" class="btn btn-primary">Volver al administrador de empleados</a>
                        </body>
                        </div>
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

<?php

if(isset($_POST["agregarEmpleado"]))
{
    
///***********************************************************************************************///
///COMO CLIENTE DEL SERVICIO WEB///
///***********************************************************************************************///

//1.- INCLUIMOS LA LIBRERIA NUSOAP DENTRO DE NUESTRO ARCHIVO
		require_once('lib/nusoap.php');
        require_once("clases/Empleado.php");

//2.- INDICAMOS URL DEL WEB SERVICE
		$host = 'http://localhost/tpEstacionamiento/ESTACIONAMIENTO_2017/loginWS.php';
		
//3.- CREAMOS LA INSTANCIA COMO CLIENTE
		$client = new nusoap_client($host . '?wsdl');

//3.- CHECKEAMOS POSIBLES ERRORES AL INSTANCIAR
		$err = $client->getError();
		if ($err) 
        {
			echo '<h2>ERROR EN LA CONSTRUCCION DEL WS:</h2><pre>' . $err . '</pre>';
			die();
		}

		$persona["usuario"] = $_POST["usuario"];
        $persona["nombre"] = $_POST["nombre"];
        $persona["apellido"] = $_POST["apellido"];
        $persona["password"] = $_POST["password"];
        $persona["turno"] = $_POST["turno"];
        $persona["condicion"] = $_POST["condicion"];
        $persona["administrador"] = $_POST["administrador"];

//4.- INVOCAMOS AL METODO SOAP, PASANDOLE EL PARAMETRO DE ENTRADA
		$result = $client->call('registrarEmpleado', array($persona));

//5.- CHECKEAMOS POSIBLES ERRORES AL INVOCAR AL METODO DEL WS 
		if ($client->fault) 
        {
			echo '<h2>ERROR AL INVOCAR METODO:</h2><pre>';
			print_r($result);
			echo '</pre>';
		} 
		else 
        {// CHECKEAMOS POR POSIBLES ERRORES
			$err = $client->getError();
			if ($err) 
            {//MOSTRAMOS EL ERROR
				echo '<h2>ERROR EN EL CLIENTE:</h2><pre>' . $err . '</pre>';
			} 
			else 
            {//MOSTRAMOS EL RESULTADO DEL METODO DEL WS.
				if($result == "agregado")
				{
                    Empleado::ActualizarOperaciones($_SESSION["empleado"]);
                    echo "</br><pre style='background-color:black;'><div class='alert alert-success text-center'>Empleado <strong>agregado</strong></div></pre>";
				}
				else
				{
					echo "</br><pre style='background-color:black;'><div class='alert alert-danger text-center'><strong>Error</strong> al agregar empleado, ese nombre de usuario ya existe!</div></pre>";
				}
			}
		}
}

?>