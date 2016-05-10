<?php
/**
 * Doghouse_Location_Model_Location
 *
 * @category  Doghouse
 * @package   Doghouse_Location
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Location/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Location
 */
class Doghouse_Location_Model_Location extends Mage_Core_Model_Abstract
{
    /**
     * Store hours
     */
    protected $_hours;

    /**
     * Init location model.
     */
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
