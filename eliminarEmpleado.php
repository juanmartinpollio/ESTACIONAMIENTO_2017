<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TP Estacionamiento - Eliminar Empleado</title>
    <!--<script type="text/javascript" src="../jquery.js"></script>
    <script type="text/javascript" src="../funciones.js"></script>-->
</head>
<body>
    <form action="eliminarEmpleado.php" method="POST">
        <h2>Eliminar empleado</h2>
        Usuario del empleado a eliminar:
        </br>
        <input type="text" name="usuario">
        </br>
        </br>
        <input type="submit" name="eliminarEmpleado" value="Eliminar empleado">
    </form>
    </br>
    </br>
    <a href="menuAdministrarEmpleados.php">Volver al administrador de empleados</a>
</body>
</html>

<?php

if(isset($_POST["eliminarEmpleado"]))
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

//4.- INVOCAMOS AL METODO SOAP, PASANDOLE EL PARAMETRO DE ENTRADA
		$result = $client->call('despedirEmpleado', array($_POST["usuario"]));

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
				if($result == "borrado")
				{
					echo "</br>Empleado correctamente eliminado";
				}
				else
				{
					if($result == "yaBorrado")
                    {
                        echo "</br>El empleado ya ha sido borrado anteriormente";
                    }
                    else
                    {
                        echo "</br>El empleado no existe";
                    }
				}
			}
		}
}

?>