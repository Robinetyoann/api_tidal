<?php
//MODELS
require_once('./models/User.php');
require_once('./models/JWT.php');

//LIB
require_once('./lib/response_json.php');
require_once('./lib/body_request.php');

class ControllerAuthentification
{
    private $_userModel;
    private $_users;

    public function __construct($url)
    {
        if (!isset($url)) {
            $array = [
                'success' => false,
                'message' => 400
            ];
            $this->_users['message'] = $array;
        } else {


            switch ($_SERVER["REQUEST_METHOD"]) {
                case 'GET':
                   
                    json(200, body_request());
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
                        case 'check':
                            $this->check_token();
                    }
            }
        }
    }

    private function login()
    {
        $email = (isset($_POST['email'])) ? $_POST['email'] : NULL;
        $pwd = (isset($_POST['password'])) ? $_POST['password'] : NULL;

        if ($email != NULL && $pwd != NULL) {
            $user = new User($email, $pwd);
            $user=$user->login();
            if (!$user) {
                json(400, "Email ou mot de passe incorrect !");
            } else {

                $header = [
                    'typ' => 'JWT',
                    'alg' => 'HS256'
                ];
                $payload = [
                    'id' => $user->id,
                    'email' => $user->email
                ];
                //json(200, "Authentification réussite");
                $token = new JWT();
                json(200, [['token' => $token->generate($header, $payload)], ['message' => "Authentification réussite"]]);
            }
        } else {
            json(400,  "Email et mot de passe requis !");
        }
    }

    private function register()
    {
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

    private function check_token()
    {
        $token_decoded=  JWT::token_validation();   
        json($token_decoded['code'], $token_decoded['data']);

    }
}
