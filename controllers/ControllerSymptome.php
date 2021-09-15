<?php

require_once('./models/SymptomeManager.php');

class ControllerSymptome {
    private $_symptomeManager;
    private $_symptomes;

    public function __construct($url) {
        $this->_symptomeManager = new SymptomeManager;
        if(count($url) === 1 && gettype($url[0]) === 'string') {
            $this->symptomes();
        } elseif (count($url) > 1 && gettype($url[0]) === 'string') {
            $this->populate();
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

    private function populate() {
        /*$array = [
            'success' => true,
            'message' => 200,
            'data' => $this->_symptomeManager->populateSymptomes()
        ];
        echo json_encode($array);*/
    }
}