<?php
require_once('./models/User.php');

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

            //print_r($url);
            switch ($_SERVER["REQUEST_METHOD"]) {
                case 'GET':
                    echo 'get';
                    break;

                case 'POST':
                    $page =  (isset($url[1])) ? $url[1] : NULL;
                    switch ($page) {
                        case NULL:
                            echo 'login';
                            $email = (isset($_POST['email'])) ? $_POST['email'] : NULL;
                            $pwd = (isset($_POST['password'])) ? $_POST['password'] : NULL;

                            if ($email != NULL && $pwd != NULL) {
                                $user = new User($email, $pwd);
                                if ($user->login()) {
                                    echo json_encode([
                                        'success' => true,
                                        'message' => "Authentification réussite"
                                    ]);
                                } else {
                                    echo json_encode([
                                        'success' => false,
                                        'message' => "Echec de l'authentification !"
                                    ]);
                                }
                            } else {
                                echo json_encode([
                                    'success' => false,
                                    'message' => "email et mot de passe requis !"
                                ]);
                            }
                            break;

                        case 'register':
                            echo 'register';
                            $email = (isset($_POST['email'])) ? $_POST['email'] : NULL;
                            $pwd = (isset($_POST['password'])) ? $_POST['password'] : NULL;
                            if ($email != NULL && $pwd != NULL) {
                                $new_user = new User($email, $pwd);
                                if ($new_user) {
                                    echo json_encode([
                                        'success' => true,
                                        'message' => "Utilisateur ajouté"
                                    ]);
                                } else {
                                    echo json_encode([
                                        'success' => false,
                                        'message' => "Erreur d'ajout de l'utilisateur"
                                    ]);
                                }
                            } else {
                                echo json_encode([
                                    'success' => false,
                                    'message' => 'email et mot de passe requis ! '
                                ]);
                            }
                            break;


                        
                    }
    
                default:
                    // Requête invalide
                    header("HTTP/1.0 405 Method Not Allowed");
                    break;
            }
        }
    }
}
