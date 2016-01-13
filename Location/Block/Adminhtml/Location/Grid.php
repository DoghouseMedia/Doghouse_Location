<?php
/**
 * Doghouse_Location_Block_Adminhtml_Location_Grid
 *
 * @category  Doghouse
 * @package   Doghouse_Location
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Location/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Location
 */
class Doghouse_Location_Block_Adminhtml_Location_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Construct the location grid.
     *
     * Doghouse_Location_Block_Adminhtml_Location_Grid constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId("locationGrid");
        $this->setDefaultSort("id");
        $this->setUseAjax(true);
        $this->setDefaultDir("ASC");
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare collection for the location grid.
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $this->setCollection(Mage::getModel("dhlocation/location")->getCollection());
        return parent::_prepareCollection();
    }

    /**
     * Prepare columns for location grid.
     *
     * @return $this
     * @throws Exception
     */
    protected function _prepareColumns()
    {

        $this->addColumn("id", array(
            "header" => Mage::helper("dhlocation")->__("ID"),
            "align" =>"right",
            "width" => "50px",
            "type" => "number",
            "index" => "id",
        ));

        $this->addColumn("name", array(
            "header" => Mage::helper("dhlocation")->__("Name"),
            "index" => "name",
        ));

        $this->addColumn("image", array(
            "header" => Mage::helper("dhlocation")->__("Image"),
            "index" => "image",
            "width" => "200px",
            "renderer" => "Doghouse_Location_Block_Adminhtml_Location_Grid_Renderer_Image",
        ));

        $this->addColumn("address", array(
            "header" => Mage::helper("dhlocation")->__("Address"),
            "index" => "address",
        ));

        $this->addColumn("suburb", array(
            "header" => Mage::helper("dhlocation")->__("Suburb"),
            "index" => "suburb",
        ));

        $this->addColumn("state", array(
            "header" => Mage::helper("dhlocation")->__("State"),
            "index" => "state",
        ));

        $this->addColumn("email", array(
            "header" => Mage::helper("dhlocation")->__("Email"),
            "index" => "email",
        ));

        $this->addColumn("item_order", array(
            "header" => Mage::helper("dhlocation")->__("Order"),
            "index" => "item_order",
            "align" =>"right",
            "width" => "50px",
            "type" => "number",
        ));

        $this->addColumn('created_at', array(
            'header'    => Mage::helper('dhlocation')->__('Created At'),
            'type'      => 'date',
            'align'     => 'center',
            'index'     => 'created_at',
        ));

        $this->addColumn('updated_at', array(
            'header'    => Mage::helper('dhlocation')->__('Updated At'),
            'type'      => 'date',
            'align'     => 'center',
            'index'     => 'updated_at',
        ));

        Mage::dispatchEvent('dhlocation_location_grid_prepare_after', array('block' => $this));

        return parent::_prepareColumns();

    }

    /**
     * Get location row url.
     *
     * @param $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl("*/*/edit", array("id" => $row->getId()));
    }

    /**
     * Ger location grid url.
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    /**
     * Prepare mass action for location grid.
     *
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('ids');
        $this->getMassactionBlock()->setUseSelectAll(true);
        $this->getMassactionBlock()->addItem('remove_item', array(
            'label'=> Mage::helper('dhlocation')->__('Remove'),
            'url'  => $this->getUrl('*/location/massRemove'),
            'confirm' => Mage::helper('dhlocation')->__('Are you sure?')
        ));
        return $this;
    }

}