<?php

class SymptomeManager extends Model {

    public function getSymptomes() {
        return $this->getAll('symptomes', 'Symptome');
    }

}