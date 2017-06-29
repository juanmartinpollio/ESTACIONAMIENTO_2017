<?php

require "clases/Empleado.php";

session_start();

if(isset($_SESSION["empleado"]))
{
	$arrayDeEmpleados = [];
	$arrayDeEmpleados = Empleado::TraerTodosLosEmpleadosBD();

	foreach ($arrayDeEmpleados as $item) 
	{
		if($item->GetUsuario() == $_SESSION["empleado"])
		{
			if($item->GetAdministrador() == 0)
			{
				header("Location:menuAdministrador.php");
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
	echo '<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>TP Estacionamiento - Ingreso como empleado</title>
		<link href="estilos/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>
	<body background="http://aktivdv.ru/uploads/sale/993631b1b5024877198f35f1aa817d26.jpg">
		<div class="form-group text-center">
			<font color="black"><h3 style="background-color:white;">LOGIN DEL PERSONAL</h3></font>
			<form action="index.php" method="POST">
			<font color="black">Usuario:</font>
			</br>
			<input type="text" name="txtEmpleado" id="txtEmpleado" placeholder="Usuario" required>
			</br>
			<font color="black">Contraseña:</font>
			</br>
			<input type="password" name="txtPassword" id="txtPassword" placeholder="Password" required>
			</br>
			</br>
			<input class="btn btn-success" type="submit" name="login" value="Ingresar">
		</form>
		</div>

	</body>
	</html>';
}




if(isset($_POST["txtEmpleado"]) && isset($_POST["txtPassword"]) && isset($_POST["login"]))
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

		$usuario["usuario"] = $_POST["txtEmpleado"];
		$usuario["password"] = $_POST["txtPassword"];

//4.- INVOCAMOS AL METODO SOAP, PASANDOLE EL PARAMETRO DE ENTRADA
		$result = $client->call('verificarUsuario', array($usuario));

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
				if($result == "administrador")
				{
					session_start();
					$_SESSION["empleado"] = $_POST["txtEmpleado"];
					Empleado::RegistrarLogin($_SESSION["empleado"],date("Y-m-d"));
					header("Location:menuAdministrador.php");
				}
				else
				{
					if($result == "empleado")
					{
						session_start();
						$_SESSION["empleado"] = $_POST["txtEmpleado"];
						Empleado::RegistrarLogin($_SESSION["empleado"],date("Y-m-d"));
						header("Location:menuEmpleado.php");
					}
					else
					{
						echo "El usuario ingresado no existe";
					}
				}
			}
		}
}

?>