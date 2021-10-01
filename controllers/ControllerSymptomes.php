<?php

require_once('./models/SymptomeManager.php');
require_once('./lib/response_json.php');
require_once('./lib/body_request.php');

class ControllerSymptomes {
    private $_symptomeManager;
    private $_symptomes;

    public function __construct($url) {
        $this->_symptomeManager = new SymptomeManager;

        if(count($url) !== 1 || gettype($url[0]) !== 'string') {json(500, 'No valid params');}

        if (!empty(body_request())) {
            $this->populateSymptomes();
        } else {
            $this->symptomes();
        }
        
    }

    private function symptomes() {
        try {
            $data = $this->_symptomeManager->getSymptomes();
            json(200, $data);
        } catch (Exception $e) {
            json(500, 'No data');
        }
    }

    private function populateSymptomes() {
        $params = body_request();
        foreach ($params as $key => $param) {
            switch ($key) {
                case 'join':
                    $joins = $param;
                    break;
                default:
                    json(500, 'Null');
            }
        }

        if (gettype($joins) === 'string'){
            $joins = array($joins);
        }

        $array = [
            'success' => true,
            'message' => 200,
            'data' => $this->_symptomeManager->populateSymptomes($joins)
        ];
        echo json_encode($array);
    }
}