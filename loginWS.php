<?php

///***********************************************************************************************///
///COMO PROVEEDOR DEL SERVICIO WEB///
///***********************************************************************************************///

//1.- INCLUIMOS LA LIBRERIA NUSOAP DENTRO DE NUESTRO ARCHIVO
	require_once('lib/nusoap.php'); 
	require_once("clases/Empleado.php");

//2.- CREAMOS LA INSTACIA AL SERVIDOR
	$server = new nusoap_server(); 

//3.- INICIALIZAMOS EL SOPORTE WSDL (Web Service Description Language)
	$server->configureWSDL('Mi Web Service #2', 'urn:EstacionamientoWS'); 

//3.1- AGREGAR DATO COMPLEJO
	$server->wsdl->addComplexType(
	
		'user', // the type's name
		'complexType',
		'struct',
		'all',
		'',
		array('usuario' => array('name' => 'usuario', 'type' => 'xsd:string'),
			  'password' => array('name' => 'password', 'type' => 'xsd:string')
    	)
	);

	$server->wsdl->addComplexType(
	
		'personal', // the type's name
		'complexType',
		'struct',
		'all',
		'',
		array('usuario' => array('name' => 'usuario', 'type' => 'xsd:string'),
			  'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
			  'apellido' => array('name' => 'apellido', 'type' => 'xsd:string'),
			  'password' => array('name' => 'password', 'type' => 'xsd:string'),
			  'turno' => array('name' => 'turno', 'type' => 'xsd:int'),
			  'condicion' => array('name' => 'condicion', 'type' => 'xsd:int'),
			  'administrador' => array('name' => 'administrador', 'type' => 'xsd:int')
    	)
	);

//4.- REGISTRAMOS EL METODO A EXPONER
	$server->register('verificarUsuario',                	// METODO
				array('usuario' => 'tns:user'),  	// PARAMETROS DE ENTRADA
				array('return' => 'xsd:string'),    		// PARAMETROS DE SALIDA
				'urn:EstacionamientoWS',                			// NAMESPACE
				'urn:EstacionamientoWS#verificarUsuario',           	// ACCION SOAP
				'rpc',                        			// ESTILO
				'encoded',                    			// CODIFICADO
				'Verificamos si el usuario existe'   // DOCUMENTACION
			);

	$server->register('registrarEmpleado',                	// METODO
	array('persona' => 'tns:personal'),  	// PARAMETROS DE ENTRADA
	array('return' => 'xsd:string'),    		// PARAMETROS DE SALIDA
	'urn:EstacionamientoWS',                			// NAMESPACE
	'urn:EstacionamientoWS#registrarEmpleado',           	// ACCION SOAP
	'rpc',                        			// ESTILO
	'encoded',                    			// CODIFICADO
	'Registra el empleado'   // DOCUMENTACION
	);

	$server->register('despedirEmpleado',                	// METODO
	array('usuario' => 'xsd:string'),  	// PARAMETROS DE ENTRADA
	array('return' => 'xsd:string'),    		// PARAMETROS DE SALIDA
	'urn:EstacionamientoWS',                			// NAMESPACE
	'urn:EstacionamientoWS#despedirEmpleado',           	// ACCION SOAP
	'rpc',                        			// ESTILO
	'encoded',                    			// CODIFICADO
	'Despide el empleado deseado'   // DOCUMENTACION
	);

	$server->register('suspenderEmpleado',                	// METODO
	array('usuario' => 'xsd:string'),  	// PARAMETROS DE ENTRADA
	array('return' => 'xsd:string'),    		// PARAMETROS DE SALIDA
	'urn:EstacionamientoWS',                			// NAMESPACE
	'urn:EstacionamientoWS#suspenderEmpleado',           	// ACCION SOAP
	'rpc',                        			// ESTILO
	'encoded',                    			// CODIFICADO
	'Suspende al empleado deseado'   // DOCUMENTACION
	);

	$server->register('habilitarEmpleado',                	// METODO
	array('usuario' => 'xsd:string'),  	// PARAMETROS DE ENTRADA
	array('return' => 'xsd:string'),    		// PARAMETROS DE SALIDA
	'urn:EstacionamientoWS',                			// NAMESPACE
	'urn:EstacionamientoWS#habilitarEmpleado',           	// ACCION SOAP
	'rpc',                        			// ESTILO
	'encoded',                    			// CODIFICADO
	'Habilita al empleado deseado'   // DOCUMENTACION
	);

//5.- DEFINIMOS EL METODO COMO UNA FUNCION PHP

	function verificarUsuario($usuario) 
    {
        $arrayDeEmpleados = Empleado::TraerTodosLosEmpleadosBD();

        foreach ($arrayDeEmpleados as $item)
        {
            if($item->GetUsuario() == $usuario["usuario"] && $item->GetPassword() == $usuario["password"])
            {
                if($item->GetAdministrador() == 0)
                {
                    return "administrador";
                }
                else
                {
					return "empleado";
                }
            }
        }

        return "no existe";
	}

	function registrarEmpleado($persona)
	{
		$arrayDeEmpleados = Empleado::TraerTodosLosEmpleadosBD();

		foreach ($arrayDeEmpleados as $item) 
		{
			if($item->GetUsuario() == $persona["usuario"])
			{
				return "error";
			}
		}

		$empleado = new Empleado(NULL,$persona["usuario"],$persona["nombre"],$persona["apellido"],$persona["password"],$persona["turno"],$persona["condicion"],$persona["administrador"]);

		if(Empleado::GuardarEnBD($empleado))
		{
			return "agregado";
		}
		else
		{	
			return "error";
		}
	}

	function despedirEmpleado($usuario)
	{
		$pdo = new PDO("mysql:host=localhost;dbname=tpEstacionamiento","root","");

		$arrayDeEmpleados = Empleado::TraerTodosLosEmpleadosBD();

		foreach ($arrayDeEmpleados as $item) 
		{
			if($item->GetUsuario() == $usuario && $item->GetCondicion() == "2")
			{
				return "yaBorrado";
			}
		}

		$consulta = $pdo->prepare("UPDATE `empleados` SET condicion='2' WHERE usuario='$usuario'");
		$consulta->execute();

		$arrayDeEmpleados = Empleado::TraerTodosLosEmpleadosBD();

		foreach ($arrayDeEmpleados as $item) 
		{
			if($item->GetUsuario() == $usuario && $item->GetCondicion() == "2")
			{
				return "borrado";
			}
		}

		return "error";
	}

	function suspenderEmpleado($usuario)
	{
		$pdo = new PDO("mysql:host=localhost;dbname=tpEstacionamiento","root","");

		$arrayDeEmpleados = Empleado::TraerTodosLosEmpleadosBD();

		foreach ($arrayDeEmpleados as $item) 
		{
			if($item->GetUsuario() == $usuario && $item->GetCondicion() == "1")
			{
				return "yaSuspendido";
			}
		}

		$consulta = $pdo->prepare("UPDATE `empleados` SET condicion='1' WHERE usuario='$usuario'");
		$consulta->execute();

		$arrayDeEmpleados = Empleado::TraerTodosLosEmpleadosBD();

		foreach ($arrayDeEmpleados as $item) 
		{
			if($item->GetUsuario() == $usuario && $item->GetCondicion() == "1")
			{
				return "suspendido";
			}
		}

		return "error"; 
	}

	function habilitarEmpleado($usuario)
	{
		$pdo = new PDO("mysql:host=localhost;dbname=tpEstacionamiento","root","");

		$arrayDeEmpleados = Empleado::TraerTodosLosEmpleadosBD();

		foreach ($arrayDeEmpleados as $item) 
		{
			if($item->GetUsuario() == $usuario && $item->GetCondicion() == "0")
			{
				return "yaHabilitado";
			}
		}

		$consulta = $pdo->prepare("UPDATE `empleados` SET condicion='0' WHERE usuario='$usuario'");
		$consulta->execute();

		$arrayDeEmpleados = Empleado::TraerTodosLosEmpleadosBD();

		foreach ($arrayDeEmpleados as $item) 
		{
			if($item->GetUsuario() == $usuario && $item->GetCondicion() == "0")
			{
				return "habilitado";
			}
		}

		return "error"; 
	}

//6.- USAMOS EL PEDIDO PARA INVOCAR EL SERVICIO
	$HTTP_RAW_POST_DATA = file_get_contents("php://input");
	
	$server->service($HTTP_RAW_POST_DATA);


?>