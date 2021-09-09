<?php

class Symptome {

    private $_idS;
    private $_desc;

    public function __construct(array $data) {
        $this->hydrate($data);
    }

    public function hydrate(array $data) {
        foreach($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method))
                $this->$method($value);
        }
    }

    public function setIdS($id) {
        $id = (int) $id;
        if($id > 0)
            $this->_idS = $id;
    }

    public function setDesc($desc) {
        if(is_string($desc))
            $this->_desc = $desc;
    }

    public function getIdS() {
        return $this->_idS;
    }

    public function getDesc() {
        return $this->_desc;
    }
}