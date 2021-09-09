<?php

require_once('./models/SymptomeManager.php');

class ControllerSymptome {
    private $_symptomeManager;

    public function __construct($url) {
        if(isset($url) && count($url) > 1)
            echo 'err';
        else
            $this->symptomes();
    }

    private function symptomes() {
        try {
            $this->_symptomeManager = new SymptomeManager;
        } catch(Exception $e) {
            echo $e;
        }

        $symptomes = $this->_symptomeManager->getSymptomes();
        print_r($symptomes);
    }
}