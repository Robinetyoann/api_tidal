<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header("Access-Control-Allow-Headers: X-Requested-With");
require_once('controllers/Router.php');
require_once('models/Model.php');

$router = new Router();
$router->routeReq();