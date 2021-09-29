<?php

class User extends Model
{
    public $_email;
    public $_password;


    public function __construct(string $email, string $password)
    {
        $this->_email = $email;
        $this->_password = $password; //;;
    }

    public function register()
    {
        try {
            $this->_password = password_hash($this->_password, PASSWORD_BCRYPT);
            $req = $this->getBdd()->prepare('INSERT INTO user (email, password) VALUES ("' . $this->_email . '","' . $this->_password . '")');
            $req->execute();
        } catch (Exception $e) {
            return false;
        }



        return true;
    }
    public function login()
    {
        try {
            $req = $this->getBdd()->prepare('SELECT * from user where email="' . $this->_email . '"');
            $req->execute();
            $user = $req->fetch(PDO::FETCH_OBJ);


            if (password_verify($this->_password, $user->password)) {
        
                return $user;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}
