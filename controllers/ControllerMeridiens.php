<?php

require_once('./models/MeridienManager.php');

class ControllerMeridiens {
    private $_meridienManager;
    private $_meridiens;

    public function __construct($url) {
        $this->meridien();
    }

    private function meridien() {
        $this->_meridienManager = new MeridienManager;
        $array = [
            'success' => true,
            'message' => 200,
            'data' => $this->_meridienManager->getMeridiens()
        ];
        echo json_encode($array);
    }
}