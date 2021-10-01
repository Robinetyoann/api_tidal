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
        if (self::$_bdd == null)
            self::setBdd();

        return self::$_bdd;
    }

    protected function getAll($table) {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM '.$table);
        $req->execute();

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            array_push($var, $data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function populate($array) {
        foreach ($array as $value) {
            echo $value;
        }
    }
}