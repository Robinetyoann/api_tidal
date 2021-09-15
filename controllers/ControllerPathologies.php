<?php

require_once('./models/PathologieManager.php');
require_once('./lib/response_json.php');

class ControllerPathologies {
    private $_pathologieManager;
    private $_pathologies;

    public function __construct($url) {
        $this->_pathologieManager = new PathologieManager;
        $this->pathologie();
    }

    private function pathologie() {
        try {
            $data = $this->_pathologieManager->getPathologies();
            json(200, $data);
        } catch (Exception $e) {
            json(500, 'No data');
        }
    }
}