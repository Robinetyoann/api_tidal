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
               
              
                $url = explode('/', filter_var($_GET['url']), FILTER_SANITIZE_URL);

                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = 'Controller'.$controller;
                $controllerFile = './controllers/'.$controllerClass.'.php';
                
              
                if(file_exists($controllerFile)) {
                    require_once($controllerFile);
                    if(!isset($url)) {
                        $array = [
                            'success' => false,
                            'message' => 400,
                            'errors' => 'Url non valide'
                        ];
                    } else {
                        $this->_ctrl = new $controllerClass($url);
                    }
                } else {
                    $array = [
                        'success' => false,
                        'message' => 400,
                        'errors' => 'Page introuvable'
                    ];
                }
            } else {
                $array = [
                    'success' => false,
                    'message' => 404,
                    'errors' => 'Indiquer un url'
                ];
            }

            if(!empty($array)) {
                echo json_encode($array);
            }
        } catch(Exception $e) {
            $array = [
                'success' => false,
                'message' => 400,
                'errors' => $e
            ];
            echo json_encode($array);
        }
    }
}