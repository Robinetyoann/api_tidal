<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
require_once('controllers/Router.php');
require_once('models/Model.php');

$router = new Router();
$router->routeReq();

//CONTROLEUR AUTHENTIFICATION





