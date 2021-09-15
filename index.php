<?php
header('Content-Type: application/json');
require_once('controllers/Router.php');
$router = new Router();
$router->routeReq();