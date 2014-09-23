<?php

class Doghouse_Location_Block_Adminhtml_Location_Grid_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

	public function render(Varien_Object $item)
	{
		$url 	= Mage::helper('dhlocation')->getImage($item);
		$alt 	= $item->getName();
		$title	= Mage::helper('dhlocation')->getImage($item);

        if($item->getImage()) {
            return sprintf('<img src="%s" alt="%s" title="%s" width="200px" class="small-image-preview v-middle" />', $url, $alt, $title);
        }

        return '';
	}

}