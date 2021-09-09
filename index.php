<?php
header('Content-Type: application/json');
require_once('controllers/Router.php');
require_once('models/Model.php');

$router = new Router();
$router->routeReq();

//CONTROLEUR AUTHENTIFICATION



require_once('models/User.php');

$request_method = $_SERVER["REQUEST_METHOD"];
switch($request_method)
  {
    
    case 'GET':
        echo "GET ";
        print_r($_GET);
        $email = $_GET['email'];
        $pwd =$_GET['password'];
        
       // $user = new User($email,$pwd );
      //  echo(  $new_user->login());
     /* if(!empty($_GET["id"]))
      {
        // Récupérer un seul produit
        $id = intval($_GET["id"]);
        getProducts($id);
      }
      else
      {
        // Récupérer tous les produits
        getProducts();
      }*/
      break;

      case 'POST':
   
        $email = $_POST['email'];
        $pwd =$_POST['password'];
        
        $new_user = new User($email,$pwd );
        echo(  $new_user->login());
      
       
       
    
      break;
    default:
      // Requête invalide
      header("HTTP/1.0 405 Method Not Allowed");
      break;

    }

