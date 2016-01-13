<?php
/**
 * Doghouse_Location_Block_Adminhtml_Location_Edit_Tabs
 *
 * @category  Doghouse
 * @package   Doghouse_Location
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Location/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Location
 */
class Doghouse_Location_Block_Adminhtml_Location_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    /**
     * COnstruct the lcoation tabs.
     *
     * Doghouse_Location_Block_Adminhtml_Location_Edit_Tabs constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('dhlocation_location_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('dhlocation')->__('Store Location'));
    }
}
