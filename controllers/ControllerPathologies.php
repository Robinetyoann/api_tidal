<?php

require_once('./models/PathologieManager.php');
require_once('./lib/response_json.php');
require_once('./lib/join_request.php');

class ControllerPathologies {
    private $_pathologieManager;
    private $_pathologies;

    public function __construct($url) {
        $this->_pathologieManager = new PathologieManager;

        if(count($url) !== 1 || gettype($url[0]) !== 'string') {json(500, 'No valid params');}

        $tablesJoin = $_GET['includes'];
        if(isset($tablesJoin)) {
            switch ($tablesJoin) {
                case 'symptomes':
                    $this->symptomes();
                    break;
            };
        } else {
            $this->pathologie();
        }
    }

    private function pathologie() {
        try {
            $data = $this->_pathologieManager->getPathologies();
            json(200, $data);
        } catch (Exception $e) {
            json(500, 'No data');
        }
    }

    private function symptomes() {
        try {
            $symptomesLinks = $this->_pathologieManager->getLinkSymptomes();
            $pathologies = $this->_pathologieManager->getPathologies();
            $symptomes = $this->_pathologieManager->getSymptomes();

            json(200, linkTables($symptomesLinks, $pathologies, $symptomes, 'idP', 'idS', 'symptomes'));
            
        } catch (Exception $e) {
            json(500, 'No data');
        }
    }
}