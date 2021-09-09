<?php

abstract class Model {
    private static $_bdd;

    private static function setBdd() {
        $host = 'localhost';
        $dbname = 'tidal';
        $user = 'root';
        $pass = 'root';
        self::$_bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $pass);
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected function getBdd() {
        if(self::$_bdd == null)
            self::setBdd();

        return self::$_bdd;
    }

    protected function getAll($table, $obj) {
        require_once('./entity/'.$obj.'.php');
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM '.$table.' ORDER BY idS asc');
        $req->execute();

        while($data = $req->fetch(PDO::FETCH_ASSOC)) {
            array_push($var, new $obj($data));
        }
        return $var;
        $req->closeCursor();
    }
}