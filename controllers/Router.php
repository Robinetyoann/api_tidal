<?php

class Router {
    private $_ctrl;
    private $_view;

    protected function is_plural($string) {
        $lastLetter = strlen($string) - 1;
        return $string[$lastLetter] === 's' ? true : false;
    }

    public function routeReq() {
        try {
            spl_autoload_register(function($class) {
                require_once('../models/'.$class.'.php');
            });

            $url = '';

            if(isset($_GET['url'])) {
                $url = explode('/', filter_var($_GET['url']), FILTER_SANITIZE_URL);

                $this->is_plural(strtolower($url[0])) ? $controller = ucfirst(strtolower(substr($url[0], 0, -1))) : $controller = ucfirst(strtolower($url[0]));
                
                $controllerClass = 'Controller'.$controller;
                $controllerFile = './controllers/'.$controllerClass.'.php';
              
                if(file_exists($controllerFile)) {
                    require_once($controllerFile);
                    $this->_ctrl = new $controllerClass($url);
                } else {
                    throw new Exception('Page introuvable');
                }
            } else {
                $array = [
                    'success' => false,
                    'message' => 404,
                ];
                echo json_encode($array);
            }
        } catch(Exception $e) {
            $array = [
                'success' => false,
                'message' => 400,
            ];
            echo json_encode($array);
        }
    }
}