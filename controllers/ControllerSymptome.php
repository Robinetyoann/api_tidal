<?php

require_once('./models/SymptomeManager.php');

class ControllerSymptome {
    private $_symptomeManager;
    private $_symptomes;

    public function __construct($url) {
        $this->symptomes();
    }

    private function symptomes() {
        $this->_symptomeManager = new SymptomeManager;
        $array = [
            'success' => true,
            'message' => 200,
            'data' => $this->_symptomeManager->getSymptomes()
        ];
        echo json_encode($array);
    }
}