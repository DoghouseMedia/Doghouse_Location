<?php
/**
 * Doghouse_Location_Model_Hour
 *
 * @category  Doghouse
 * @package   Doghouse_Location
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Location/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Location
 */
class Doghouse_Location_Model_Hour extends Mage_Core_Model_Abstract
{

    /**
     * Init the hour model.
     */
    protected function _construct()
    {
        $this->_init('dhlocation/hour');
    }

    /**
     * Check if the location is open.
     *
     * @return bool
     */
    public function isOpen() {
        if( strlen($this->getOpen()) || strlen($this->getClose()) ) {
            return true;
        }
        return false;
    }

    /**
     * Check if location is closed.
     *
     * @return bool
     */
    public function isClosed() {
        return !$this->isOpen();
    }

}