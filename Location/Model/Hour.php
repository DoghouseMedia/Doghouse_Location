<?php

class Doghouse_Location_Model_Hour extends Mage_Core_Model_Abstract {

    protected function _construct()
    {
        $this->_init('dhlocation/hour');
    }

    public function isOpen() {
        if( strlen($this->getOpen()) || strlen($this->getClose()) ) {
            return true;
        }
        return false;
    }

    public function isClosed() {
        return !$this->isOpen();
    }

}