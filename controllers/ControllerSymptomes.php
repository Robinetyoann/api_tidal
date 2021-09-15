<?php

require_once('./models/SymptomeManager.php');

class ControllerSymptomes {
    private $_symptomeManager;
    private $_symptomes;

    public function __construct($url) {
        $this->_symptomeManager = new SymptomeManager;
        if(count($url) === 1 && gettype($url[0]) === 'string' && empty($_GET['includes'])) {
            $this->symptomes();
        } elseif (count($url) === 1 && gettype($url[0]) === 'string' && empty(!$_GET)) {
            $this->populateSymptomes();
        }
        
    }

    private function symptomes() {
        $array = [
            'success' => true,
            'message' => 200,
            'data' => $this->_symptomeManager->getSymptomes()
        ];
        echo json_encode($array);
    }

    private function populateSymptomes() {
        var_dump($_GET);
        /*$array = [
            'success' => true,
            'message' => 200,
            'data' => $this->_symptomeManager->populateSymptomes()
        ];
        echo json_encode($array);*/
    }
}