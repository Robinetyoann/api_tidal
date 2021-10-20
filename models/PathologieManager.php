<?php

require_once('./models/Model.php');

class PathologieManager extends Model  {

    public function getPathologies() {
        return $this->getAll('patho');
    }
}