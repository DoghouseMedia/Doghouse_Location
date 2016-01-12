<?php

class Doghouse_Location_Block_Adminhtml_Location_Edit_Tab_Hour_Form
    extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();

        $model = Mage::registry("location_data");
        $locationId = $model->getId();

        $form->setHtmlIdPrefix('hour_');

        $gridBlock = $this->getLayout()->getBlock('location_tab_hour_grid');
        $gridBlockJsObject = '';

        if ($gridBlock) {
            $gridBlockJsObject = $gridBlock->getJsObjectName();
        }

        $fieldset = $form->addFieldset("location_form", array("legend" => Mage::helper("dhlocation")->__("Opening Hours")));
        $fieldset->addClass('ignore-validate');

        $fieldset->addField('location_id', 'hidden', array(
            'name'     => 'location_id',
            'value'    => $locationId
        ));

        $fieldset->addField("day", "text", array(
            "label" => Mage::helper("dhlocation")->__("Day of the week"),
            "class" => "required-entry",
            "required" => true,
            "name" => "day"
        ));

        $fieldset->addField("open", "text", array(
            "label" => Mage::helper("dhlocation")->__("Opening time"),
            "name" => "open"
        ));

        $fieldset->addField("close", "text", array(
            "label" => Mage::helper("dhlocation")->__("Closing time"),
            "name" => "close",
            "after_element_html" => "<br /><small>If opening and closing time are empty, it will appear as \"closed\"</small>",
        ));

        $idPrefix = $form->getHtmlIdPrefix();
        $generateUrl = $this->getGenerateUrl();

        $fieldset->addField('generate_button', 'note', array(
            'text' => $this->getButtonHtml(
                Mage::helper('dhlocation')->__('Add Hours'),
                "DOGHOUSE.Location.saveHour('{$idPrefix}' ,'{$generateUrl}', '{$gridBlockJsObject}')",
                'generate'
            )
        ));

        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Retrieve URL to Hour Action
     *
     * @return string
     */
    public function getGenerateUrl()
    {
        return $this->getUrl('*/hour/save');
    }

}
