<?php

class Doghouse_Location_Model_Resource_Location_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {

    protected function _construct()
    {
        $this->_init('dhlocation/location');
    }

}