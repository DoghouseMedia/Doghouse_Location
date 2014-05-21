<?php

class Doghouse_Location_Block_Adminhtml_Location_Edit_Tab_Hour_Grid_Renderer_Time extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $item)
    {
        if($item->isOpen()) {
            return $this->_getValue($item);
        }
        return $this->__('Closed');
    }

}