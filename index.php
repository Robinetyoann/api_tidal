<?php
header('Content-Type: application/json');
require_once('controllers/Router.php');
require_once('models/Model.php');

$router = new Router();
$router->routeReq();