<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header("Access-Control-Request-Headers: Content-Type, x-requested-with");
require_once('controllers/Router.php');
require_once('models/Model.php');

$router = new Router();
$router->routeReq();