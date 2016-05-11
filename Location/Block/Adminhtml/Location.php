<?php
/**
 * Doghouse_Location_Block_Adminhtml_Location
 *
 * @category  Doghouse
 * @package   Doghouse_Location
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Location/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Location
 */
class Doghouse_Location_Block_Adminhtml_Location extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    /**
     * Construct the location grid.
     *
     * Doghouse_Location_Block_Adminhtml_Location constructor.
     */
    public function __construct()
    {
        $this->_controller = "adminhtml_location";
        $this->_blockGroup = "dhlocation";
        $this->_headerText = Mage::helper("dhlocation")->__("Manage Store Locations");
        $this->_addButtonLabel = Mage::helper("dhlocation")->__("Add Store Location");
        parent::__construct();
    }
}
