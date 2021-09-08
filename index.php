<?php

require_once('controllers/Router.php');


require_once('models/Model.php');

$router = new Router();
$router->routeReq();

$models = new Model();
$models->getAll('symptome', '');

