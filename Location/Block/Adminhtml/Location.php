<?php

class Doghouse_Location_Block_Adminhtml_Location extends Mage_Adminhtml_Block_Widget_Grid_Container{

    public function __construct()
    {
        $this->_controller = "adminhtml_location";
        $this->_blockGroup = "dhlocation";
        $this->_headerText = Mage::helper("dhlocation")->__("Manage Store Locations");
        $this->_addButtonLabel = Mage::helper("dhlocation")->__("Add Store Location");
        parent::__construct();
    }

}