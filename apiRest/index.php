<?php

date_default_timezone_set ("America/Argentina/Buenos_Aires");

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require '../clases/AccesoDatos.php';
require '../clases/Vehiculo.php';
require '../clases/Cochera.php';

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
    $flag = TRUE;
    $array = Vehiculo::TraerTodosLosVehiculos();

    foreach ($array as $item)
    {
        if(strtolower($item["patente"]) != strtolower($vehiculo["patente"]))
        {
            $flag = TRUE;
            break;
        }
        else
        {
            $flag = FALSE;
        }
    }

    if($flag === TRUE && Vehiculo::agregarVehiculo($vehiculo["patente"],$vehiculo["color"],$vehiculo["marca"],$vehiculo["cochera"],date("Y-m-d H:i:s")))
    {
        $json["exito"] = Vehiculo::agregarAutoAlEstacionamiento($vehiculo["patente"],$vehiculo["cochera"]);
    }
    else
    {
        $json["exito"] = FALSE;
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

    $resultado["valor"] = Vehiculo::quitarAutoDelEstacionamiento($patente["patente"]);

    return json_encode($resultado["valor"]);
});

$app->run();