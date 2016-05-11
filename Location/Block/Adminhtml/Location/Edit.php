<?php
/**
 * Doghouse_Location_Block_Adminhtml_Location_Edit
 *
 * @category  Doghouse
 * @package   Doghouse_Location
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Location/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Location
 */
class Doghouse_Location_Block_Adminhtml_Location_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    /**
     * Construct the location edit form.
     *
     * Doghouse_Location_Block_Adminhtml_Location_Edit constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = "id";
        $this->_blockGroup = "dhlocation";
        $this->_controller = "adminhtml_location";
        $this->setData('form_action_url', $this->getUrl('*/*/save'));
        $this->_updateButton("save", "label", Mage::helper("dhlocation")->__("Save Location"));
        $this->_updateButton("delete", "label", Mage::helper("dhlocation")->__("Delete Location"));

        $this->_addButton("saveandcontinue", array(
            "label"     => Mage::helper("dhlocation")->__("Save And Continue Edit"),
            "onclick"   => "saveAndContinueEdit()",
            "class"     => "save",
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * Get the location header text.
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry("location_data") && Mage::registry("location_data")->getId()) {
            return Mage::helper("dhlocation")->__("Edit Location '%s'", $this->htmlEscape(Mage::registry("location_data")->getName()));
        } else {
            return Mage::helper("dhlocation")->__("Add Location");
        }
    }
}
