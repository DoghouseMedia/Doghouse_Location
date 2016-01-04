<?php

class Doghouse_Location_Model_Location extends Mage_Core_Model_Abstract
{
    /**
     * Store hours
     */
    protected $_hours;

    protected function _construct()
    {
        $this->_init('dhlocation/location');
    }

    /**
     * Get opening hours for a location.
     *
     * @return mixed
     */
    public function getHours()
    {

        if (!$this->_hours) {
            $this->_hours = Mage::getModel('dhlocation/hour')
                ->getCollection()
                ->addFieldToFilter('location_id', $this->getId());
        }

        return $this->_hours;
    }

}
