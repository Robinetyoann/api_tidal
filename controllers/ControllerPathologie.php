<?php

require_once('./models/PathologieManager.php');

class ControllerPathologie {
    private $_pathologieManager;
    private $_pathologies;

    public function __construct($url) {
        $this->pathologie();
    }

    private function pathologie() {
        $this->_pathologieManager = new PathologieManager;
        $array = [
            'success' => true,
            'message' => 200,
            'data' => $this->_pathologieManager->getPathologies()
        ];
        echo json_encode($array);
    }
}