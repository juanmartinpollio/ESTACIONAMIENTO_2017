<?php

date_default_timezone_set ("America/Argentina/Buenos_Aires");

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require '../clases/AccesoDatos.php';
require '../clases/Vehiculo.php';
require '../clases/Cochera.php';
require '../clases/Empleado.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;
/*

¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

$app = new \Slim\App(["settings" => $config]);

$app->post('/vehiculo', function (Request $request, Response $response){

    $vehiculo = array();
    $vehiculo = $request->getParsedBody();
    $flag = FALSE;
    $array = Vehiculo::TraerTodosLosVehiculosCochera();
    Empleado::ActualizarOperaciones($vehiculo["empleado"]);

    foreach ($array as $item) 
    {
        if($item["patente"] == $vehiculo["patente"])
        {
            $json["exito"] = FALSE;
            return json_encode($json["exito"]);
        }
        else
        {                    
            $flag = TRUE;
        }
    }

    if($flag === TRUE && Vehiculo::agregarVehiculo($vehiculo["patente"],$vehiculo["color"],$vehiculo["marca"],$vehiculo["cochera"],date("Y-m-d H:i:s")))
    {
        $json["exito"] = Vehiculo::agregarAutoAlEstacionamiento($vehiculo["patente"],$vehiculo["cochera"]);
    }

    return json_encode($json["exito"]);
});

$app->get('/vehiculo', function (Request $request, Response $response) {
    
    $vehiculos = array();
    $vehiculos = Vehiculo::TraerTodosLosVehiculos();

    $response->getBody()->write(json_encode($vehiculos));

    return $response;
});

$app->put('/vehiculo', function (Request $request, Response $response){
    $patente = $request->getParsedBody();

    $resultado = Vehiculo::quitarAutoDelEstacionamiento($patente["patente"]);
    Empleado::ActualizarOperaciones($patente["empleado"]);

    return json_encode($resultado);
});

$app->run();