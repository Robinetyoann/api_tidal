<?php

require_once('./models/Model.php');

class SymptomeManager extends Model  {

    private static $_table = 'symptome';
    private static $_id = 'idS';

    public function getSymptomes() {
        return $this->getAll(self::$_table);
    }

    public function populateSymptomes($array) {
        return $this->populate($array, ['table' => self::$_table, 'id' => self::$_id]);
    }
}