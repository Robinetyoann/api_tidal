<?php

require_once('./models/SymptomeManager.php');
require_once('./lib/response_json.php');
require_once('./lib/body_request.php');
require_once('./lib/join_request.php');

class ControllerSymptomes {
    private $_symptomeManager;
    private $_symptomes;

    public function __construct($url) {
        $this->_symptomeManager = new SymptomeManager;

        if(count($url) !== 1 || gettype($url[0]) !== 'string') {json(500, 'No valid params');}
        
        $tablesJoin = $_GET['includes'];
        if(isset($tablesJoin)) {
            switch ($tablesJoin) {
                case 'pathologies':
                    $this->pathologies();
                    break;
                case 'keywords':
                    $this->keywords();
                    break;
            };
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

    private function pathologies() {
        try {
            $pathologiesLinks = $this->_symptomeManager->getLinkPathologies();
            $symptomes = $this->_symptomeManager->getSymptomes();
            $pathologies = $this->_symptomeManager->getPathologies();
            json(200, linkTables($pathologiesLinks, $symptomes, $pathologies, 'idS', 'idP', 'pathologies')); 
        } catch (Exception $e) {
            json(500, 'No data');
        }
    }

    private function keywords() {
        $keywordsLinks = $this->_symptomeManager->getLinkKeywords();
        $symptomes = $this->_symptomeManager->getSymptomes();
        $keywords = $this->_symptomeManager->getKeywords();

        json(200, linkTables($keywordsLinks, $symptomes, $keywords, 'idS', 'idK', 'keywords'));
    }
}