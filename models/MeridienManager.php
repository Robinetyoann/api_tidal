<?php

require_once('./models/Model.php');

class MeridienManager extends Model  {

    public function getMeridiens() {
        return $this->getAll('meridien');
    }
}