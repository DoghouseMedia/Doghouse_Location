<?php

class Doghouse_Location_Block_Adminhtml_Location_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('dhlocation_location_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('dhlocation')->__('Store Location'));
    }
}
