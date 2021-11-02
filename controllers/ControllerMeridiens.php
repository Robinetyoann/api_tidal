<?php

require_once('./models/MeridienManager.php');
require_once('./lib/response_json.php');

class ControllerMeridiens {
    private $_meridienManager;
    private $_meridiens;

    public function __construct($url) {
        $this->_meridienManager = new MeridienManager;
        $this->meridien();
    }

    private function meridien() {
        try {
            $data = $this->_meridienManager->getMeridiens();
            json(200, $data);
        } catch (Exception $e) {
            json(500, 'No data');
        }
    }
}