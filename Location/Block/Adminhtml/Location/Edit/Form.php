<?php
/**
 * Doghouse_Location_Block_Adminhtml_Location_Edit_Form
 *
 * @category  Doghouse
 * @package   Doghouse_Location
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Location/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Location
 */
class Doghouse_Location_Block_Adminhtml_Location_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Construct the location form.
     *
     * Doghouse_Location_Block_Adminhtml_Location_Edit_Form constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('dhlocation_location_edit_form');
        $this->setTitle(Mage::helper('salesrule')->__('Store Location Information'));
    }

    /**
     * Prepare location form.
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getData('action'),
            'method'    => 'post',
            'enctype'   => 'multipart/form-data',
        ));
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
