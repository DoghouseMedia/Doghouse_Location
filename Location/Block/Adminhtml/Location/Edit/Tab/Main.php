<?php

class Doghouse_Location_Block_Adminhtml_Location_Edit_Tab_Main
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Prepare content for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('salesrule')->__('Store Information');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('salesrule')->__('Store Information');
    }

    /**
     * Returns status flag about this tab can be showed or not
     *
     * @return true
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return true
     */
    public function isHidden()
    {
        return false;
    }

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();

        $fieldset = $form->addFieldset("base_fieldset", array("legend" => Mage::helper("dhlocation")->__("Item information")));

        $model = Mage::registry("location_data");

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }

        $fieldset->addType('image', 'Doghouse_Location_Block_Adminhtml_Location_Helper_Image');

        $fieldset->addField("name", "text", array(
            "label" => Mage::helper("dhlocation")->__("Location Name"),
            "class" => "required-entry",
            "required" => true,
            "name" => "name"
        ));

        $fieldset->addField("address", "text", array(
            "label" => Mage::helper("dhlocation")->__("Address"),
            "name" => "address"
        ));

        $fieldset->addField("suburb", "text", array(
            "label" => Mage::helper("dhlocation")->__("City or Suburb"),
            "name" => "suburb"
        ));

        $fieldset->addField("state", "text", array(
            "label" => Mage::helper("dhlocation")->__("State"),
            "name" => "state"
        ));

        $fieldset->addField("phone", "text", array(
            "label" => Mage::helper("dhlocation")->__("Phone number"),
            "name" => "phone"
        ));

        $fieldset->addField("email", "text", array(
            "label" => Mage::helper("dhlocation")->__("Email"),
            "name" => "email"
        ));

        $fieldset->addField("image", "image", array(
            "label" => Mage::helper("dhlocation")->__("Image"),
            "class" => "required-entry",
            "required" => true,
            "name" => "image",
        ));

        $fieldset->addField("location_url", "text", array(
            "label" => Mage::helper("dhlocation")->__("Google Maps Location URL"),
            "name" => "location_url",
            "after_element_html" => "<small>Google Maps iframe URL (see <a target=\"_blank\" href=\"https://developers.google.com/maps/documentation/embed/guide\">Google Maps Documentation</a> for more information).</small>"
        ));

        $fieldset->addField("item_order", "text", array(
            "label" => Mage::helper("dhlocation")->__("Order"),
            "after_element_html" => "<small>Low to high</small>",
            "name" => "item_order",
        ));

        if(Mage::registry("location_data")) {
            $form->setValues(Mage::registry("location_data")->getData());
        } elseif (Mage::getSingleton("adminhtml/session")->getLocationData()) {
            $form->setValues(Mage::getSingleton("adminhtml/session")->getLocationData());
            Mage::getSingleton("adminhtml/session")->setLocationData(null);
        }

        //$form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
