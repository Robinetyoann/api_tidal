<?php

require_once('./models/Model.php');

class SymptomeManager extends Model  {
    
    private static $_table = 'symptome';
    private static $_id = 'idS';

    public function getSymptomes() {
        return $this->getAll(self::$_table);
    }

    public function getLinkPathologies() {
        return $this->getAll('symptPatho');
    }

    public function getPathologies() {
        return $this->getAll('patho');
    }

    public function getLinkKeywords() {
        return $this->getAll('keySympt');
    }

    public function getKeywords() {
        return $this->getAll('keywords');
    }
}