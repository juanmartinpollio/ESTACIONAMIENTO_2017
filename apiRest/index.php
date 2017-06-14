<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require '../clases/AccesoDatos.php';
require '../clases/Vehiculo.php';

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

    $json["exito"] = Vehiculo::agregarVehiculo($vehiculo["patente"],$vehiculo["color"],$vehiculo["marca"],$vehiculo["cochera"],date("j-m-Y G:i"));

    return json_encode($json["exito"]);
});

$app->get('/vehiculo', function (Request $request, Response $response) {
    
    $vehiculos = array();
    $vehiculos = Vehiculo::TraerTodosLosVehiculos();

    $response->getBody()->write(json_encode($vehiculos));

    return $response;
});

$app->run();