<?php

class Doghouse_Location_Block_Adminhtml_Location_Helper_Image extends Varien_Data_Form_Element_Image{

    protected function _getUrl(){

        $url = false;

        if ($this->getValue()) {
            $url =  Mage::helper('dhlocation')->getImageUrl() . $this->getValue();
        }

        return $url;
    }

}