<?php

class Doghouse_Location_Block_Location extends Mage_Core_Block_Template {

	public function getLocations() {
		return Mage::getModel('dhlocation/location')->getCollection();
	}

	public function getHours(Doghouse_Location_Model_Location $location) {
		return Mage::getModel('dhlocation/hour')->getCollection()
			->addFieldToFilter('location_id', $location->getId())
			->sortByWeekDay();
	}

}