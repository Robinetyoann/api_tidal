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
        $req = $this->getBdd()->prepare('SELECT * FROM ' . $table);
        $req->execute();

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            array_push($var, $data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function populate($arrayDest, $arraySource) {
        $var = [];
        $query = 'SELECT * FROM ' . $arraySource['table'] . ' ';
        foreach ($arrayDest as $key => $value) {
            $joinQuery = 'JOIN ' .$value->table. ' ON ' .$value->table. '.' .$value->id. '=' .$arraySource['table']. '.' .$arraySource['id'] . ' ';
            $query .= $joinQuery;
        }
        
        $req = $this->getBdd()->prepare('SELECT * FROM symptome JOIN symptPatho ON symptPatho.idS=symptome.idS');
        $req->execute();

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            array_push($var, $data);
        }
        return $var;
        $req->closeCursor();
    }
}