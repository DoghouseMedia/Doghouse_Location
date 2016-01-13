<?php
/**
 * Doghouse_Location_Block_Adminhtml_Location_Edit_Tab_Hour_Grid_Renderer_Time
 *
 * @category  Doghouse
 * @package   Doghouse_Location
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Location/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Location
 */
class Doghouse_Location_Block_Adminhtml_Location_Edit_Tab_Hour_Grid_Renderer_Time
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    /**
     * Returns a string that displays the opening/closing time of the hour
     * @param  Varien_Object $item
     * @return string
     */
    public function render(Varien_Object $item)
    {
        if($item->isOpen()) {
            return $this->_getValue($item);
        }
        return $this->__('Closed');
    }

}
