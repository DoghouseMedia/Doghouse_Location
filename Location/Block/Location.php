<?php

class Doghouse_Location_Block_Location extends Mage_Core_Block_Template {

	public function getLocations() {
		return Mage::getModel('dhlocation/location')->getCollection();
	}

    public function getLocationsByState() {
        $collection = $this->getLocations();
        $groups = array();
        foreach($collection as $item) {
            $hash = md5(strtolower($item->getState()));
            if(array_key_exists($hash, $groups)) {
                array_push($groups[$hash], $item);
            } else {
                $groups[$hash] = array($item);
            }
        }
        return $groups;
    }

	public function getHours(Doghouse_Location_Model_Location $location) {
        return $location->getHours()->sortByWeekDay();
	}

}