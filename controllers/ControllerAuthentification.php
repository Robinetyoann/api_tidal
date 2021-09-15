<?php
require_once('./models/User.php');
require_once('./lib/response_json.php');

class ControllerAuthentification {
    private $_userModel;
    private $_users;

    public function __construct($url) {
        if (!isset($url)) {
            $array = [
                'success' => false,
                'message' => 400
            ];
            $this->_users['message'] = $array;
        } else {
            switch ($_SERVER["REQUEST_METHOD"]) {
                case 'GET':
                    var_dump($_GET);
                    var_dump($url);
                    echo 'get';
                    break;
                case 'POST':
                    $page =  (isset($url[1])) ? $url[1] : NULL;
                    switch ($page) {
                        case NULL:
                            $this->login();
                            break;

                        case 'register':
                            $this->register();
                            break;
                    }
                default:
                    // Requête invalide
                echo $_SERVER["REQUEST_METHOD"];
                    json(405, "Method Not Allowed");
                   
            }
        }
    }

    private function login() {
        $email = (isset($_POST['email'])) ? $_POST['email'] : NULL;
        $pwd = (isset($_POST['password'])) ? $_POST['password'] : NULL;

        if ($email != NULL && $pwd != NULL) {
            $user = new User($email, $pwd);
            if ($user->login()) {
                json(200, "Authentification réussite");
            } else {
                json(400, "Email ou mot de passe incorrect !");
            }
        } else {
            json(400,  "Email et mot de passe requis !");
        }
    }

    private function register() {
        $email = (isset($_POST['email'])) ? $_POST['email'] : NULL;
        $pwd = (isset($_POST['password'])) ? $_POST['password'] : NULL;
        if ($email != NULL && $pwd != NULL) {
            $new_user = new User($email, $pwd);
            if ($new_user->register()) {
                json(200, "Utilisateur ajouté");
            } else {
                json(400,  "Erreur d'ajout de l'utilisateur");
            }
        } else {
            json(400, "Email et mot de passe requis !");
        }
    }
}