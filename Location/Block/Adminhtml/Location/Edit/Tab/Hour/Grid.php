<?php
/**
 * Doghouse_Location_Block_Adminhtml_Location_Edit_Tab_Hour_Grid
 *
 * @category  Doghouse
 * @package   Doghouse_Location
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Location/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Location
 */
class Doghouse_Location_Block_Adminhtml_Location_Edit_Tab_Hour_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{

    /**
     * Construct the grid.
     *
     * Doghouse_Location_Block_Adminhtml_Location_Edit_Tab_Hour_Grid constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId("hourGrid");
        $this->setDefaultSort("id");
        $this->setUseAjax(true);
        $this->setDefaultDir("ASC");
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare the collection for the grid.
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $location = Mage::registry('location_data');

        $collection = Mage::getModel("dhlocation/hour")
            ->getCollection()
            ->addFieldToFilter('location_id', $location->getId())
            ->sortByWeekDay();

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * Prepare the columns.
     *
     * @return $this
     * @throws Exception
     */
    protected function _prepareColumns()
    {

        $this->addColumn("hour_day", array(
            "header" => Mage::helper("dhlocation")->__("Day"),
            "index" => "day",
        ));

        $this->addColumn("hour_open", array(
            "header" => Mage::helper("dhlocation")->__("Opening time"),
            "index" => "open",
            "renderer" => "Doghouse_Location_Block_Adminhtml_Location_Edit_Tab_Hour_Grid_Renderer_Time",
        ));

        $this->addColumn("hour_close", array(
            "header" => Mage::helper("dhlocation")->__("Closing time"),
            "index" => "close",
            "renderer" => "Doghouse_Location_Block_Adminhtml_Location_Edit_Tab_Hour_Grid_Renderer_Time",
        ));

        $this->addColumn('hour_created_at', array(
            'header'    => Mage::helper('dhlocation')->__('Created At'),
            'type'      => 'date',
            'align'     => 'center',
            'index'     => 'created_at',
        ));

        $this->addColumn('hour_updated_at', array(
            'header'    => Mage::helper('dhlocation')->__('Updated At'),
            'type'      => 'date',
            'align'     => 'center',
            'index'     => 'updated_at',
        ));

        return parent::_prepareColumns();

    }

    /**
     * Grid Url.
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/hour/grid', array('_current'=>true));
    }

    /**
     * Prepare mass actions for the grid.
     *
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('hour_id');
        $this->getMassactionBlock()->setFormFieldName('hour_ids');
        $this->getMassactionBlock()->setUseSelectAll(true);
        $this->getMassactionBlock()->setUseAjax(true);
        $this->getMassactionBlock()->setHideFormElement(true);

        $this->getMassactionBlock()->addItem('remove_item', array(
            'label'=> Mage::helper('dhlocation')->__('Remove'),
            'url'  => $this->getUrl('*/hour/massRemove'),
            'confirm' => Mage::helper('dhlocation')->__('Are you sure?'),
            'complete' => 'DOGHOUSE.Location.refreshHourGrid'
        ));
        return $this;
    }

}
