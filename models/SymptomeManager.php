<?php

require_once('./models/Model.php');

class SymptomeManager extends Model  {

    public function getSymptomes() {
        return $this->getAll('symptome');
    }

    public function populateSymptomes() {
        return $this->populate(['test', 'test']);
    }
}