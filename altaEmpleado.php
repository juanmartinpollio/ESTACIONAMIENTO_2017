<!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>TP Estacionamiento - Agregar Empleado</title>
        </head>
        <body>
            <form action="altaEmpleado.php" method="POST">
                <h2>Registro del nuevo empleado</h2>
                Usuario:
                </br>
                <input type="text" name="usuario" required>
                </br>
                Nombre:
                </br>
                <input type="text" name="nombre" required>
                </br>
                Apellido:
                </br>
                <input type="text" name="apellido" required>
                </br>
                Contraseña:
                </br>
                <input type="password" name="password" required>
                </br>
                Turno:
                </br>
                <select name="turno" id="turno" required>
                <option value="0">Mañana</option>
                <option value="1">Noche</option>
                <option value="2">Tarde</option>
                </select>
                </br>
                Condicion:
                </br>
                <select name="condicion" required> 
                <option value="0">Habilitado</option>
                <option value="1">Suspendido</option>
                </select>
                </br>
                Administrador:
                </br>
                <select name="administrador" required>
                <option value="0">Activado</option>
                <option value="1">Desactivado</option>
                </select>
                </br>
                </br>
                <input type="submit" name="agregarEmpleado" value="Agregar empleado">
            </form>
            </br>
            </br>
            <a href="menuAdministrarEmpleados.php">Volver al administrador de empleados</a>
        </body>
        </html>

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
                    header("Location:menuAdministrador.php");
				}
				else
				{
					echo "</br>Error al agregar empleado";
				}
			}
		}
}

?>