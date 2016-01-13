<?php
/**
 * Doghouse_Location_Block_Location
 *
 * @category  Doghouse
 * @package   Doghouse_Location
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Location/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Location
 */
class Doghouse_Location_Block_Location extends Mage_Core_Block_Template
{

    /**
     * Get locations.
     *
     * @return object
     */
    public function getLocations()
    {
        return Mage::getModel('dhlocation/location')->getCollection();
    }

    /**
     * Get locations by state.
     *
     * @return array
     */
    public function getLocationsByState()
    {
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

    /**
     * Get location hours.
     *
     * @param Doghouse_Location_Model_Location $location
     * @return mixed
     */
    public function getHours(Doghouse_Location_Model_Location $location)
    {
        return $location->getHours()->sortByWeekDay();
    }

}
