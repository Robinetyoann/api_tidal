<?php

require_once('./models/PathologieManager.php');

class ControllerPathologie {
    private $_pathologieManager;
    private $_pathologies;

    public function __construct($url) {
        if(isset($url) && count($url) > 1) {
            $array = [
                'success' => false,
                'message' => 400
            ];
            $this->_pathologies['message'] = $array;
        } else {
            $this->pathologie();
        }
            
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