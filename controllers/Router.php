<?php
require_once('./lib/get_token.php');
class Router {
    private $_ctrl;
    private $_view;

    public function routeReq() {
        try {
            spl_autoload_register(function($class) {
                require_once('../models/'.$class.'.php');
            });

            $url = '';

            if(isset($_GET['url'])) {
               
                //file_put_contents('log.txt',$_GET['url']);
                $url = explode('/', filter_var($_GET['url']), FILTER_SANITIZE_URL);

                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = 'Controller'.$controller;
                $controllerFile = './controllers/'.$controllerClass.'.php';
                
              
                if(file_exists($controllerFile)) {
                    require_once($controllerFile);
                    $this->_ctrl = new $controllerClass($url);
                } else {
                    throw new Exception('Page introuvable');
                }
            } else {
                echo 'pas de page';
            }
        } catch(Exception $e) {
            $errorMsg = $e->getMessage();
            echo $e;
        }
    }
}