<?php

require_once('./models/SymptomeManager.php');

class ControllerSymptomes {
    private $_symptomeManager;
    private $_symptomes;

    public function __construct($url) {
        if(isset($url) && count($url) > 1) {
            $array = [
                'success' => false,
                'message' => 400
            ];
            $this->_symptomes['message'] = $array;
        } else {
            $this->symptomes();
        }  
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