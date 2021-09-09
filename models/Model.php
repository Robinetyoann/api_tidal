<?php

 class Model {
    private static $_bdd;

    private static function setBdd() {
        $host = 'localhost';
        $dbname = 'tidal';
        $user = 'root';
        $pass = '';
        self::$_bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $pass);
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

       
    }

    public function getBdd() {
       
        if(self::$_bdd == null)
            self::setBdd();

        return self::$_bdd;
    }

    public function getAll($table, $obj) {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM '.$table.' ORDER BY idS asc');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)) {
           // $var = new $obj($data);
         //  print_r($data) ;
        }
        //return $var;
        $req->closeCursor();
    }
}