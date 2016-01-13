<?php
/**
 * Doghouse_Location_Block_Adminhtml_Location_Grid_Renderer_Image
 *
 * @category  Doghouse
 * @package   Doghouse_Location
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Location/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Location
 */
class Doghouse_Location_Block_Adminhtml_Location_Grid_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

	/**
	 * Render location image on grid.
	 *
	 * @param Varien_Object $item
	 * @return string
	 */
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