<?php

const CRYPTED_PWD = '$2y$10$n1hpKeYzE5U5SNjext7rO.BsYkkEajGNZCE53G23uh1thZ4mAMG4S';
class User extends Model{
    public $_email;
    public $_password;
    

    public function __construct(string $email, string $password) {
        $this->_email = $email;
        $this->_password = $password;//;;
    }

    public function register(){
        $this->_password = password_hash( $this->_password, PASSWORD_BCRYPT);
        return  true;
        
    }
    public function login(){
        if(password_verify($this->_password, CRYPTED_PWD)){
            return 'Authentificaiton réussite';
        }else{
            return '\nAuthentification failed';
        }
    }
}   