<?php

require_once('./models/Model.php');

class PathologieManager extends Model  {

    private static $_table = 'patho';

    public function getPathologies() {
        return $this->getAll(self::$_table);
    }

    public function getLinkSymptomes() {
        return $this->getAll('symptPatho');
    }

    public function getSymptomes() {
        return $this->getAll('symptome');
    }

    public function getMeridiens() {
        return $this->getAll('meridien');
    }
}