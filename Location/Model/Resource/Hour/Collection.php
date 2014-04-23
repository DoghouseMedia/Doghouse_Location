<?php

class Doghouse_Location_Model_Resource_Hour_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {

    protected function _construct()
    {
        $this->_init('dhlocation/hour');
    }

    static function sortByWeekDayFunc($a, $b) {

    	$a = substr(strtolower($a->getDay()), 0, 2);
    	$b = substr(strtoLower($b->getDay()), 0, 2);

    	$days = array(
    		"mo",
    		"tu",
    		"we",
    		"th",
    		"fr",
    		"sa",
    		"su"
    	);

    	$indexA = array_search($a, $days);
    	$indexB = array_search($b, $days);

    	if($indexA === $indexB) {
    		return 0;
    	}

    	return ($indexA < $indexB) ? -1 : 1;

    }

    public function sortByWeekDay() {

    	if(!$this->_isCollectionLoaded) {
    		$this->load();
    	}

    	usort($this->_items, array("Doghouse_Location_Model_Resource_Hour_Collection", "sortByWeekDayFunc"));

    	return $this;
    }

}