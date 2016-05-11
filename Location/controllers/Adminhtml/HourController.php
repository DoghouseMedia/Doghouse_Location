<?php
/**
 * Doghouse_Location_Adminhtml_HourController
 *
 * @category  Doghouse
 * @package   Doghouse_Location
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Location/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Location
 */
class Doghouse_Location_Adminhtml_HourController extends Mage_Adminhtml_Controller_Action
{

    /**
     * Init location action.
     */
    protected function _initLocation()
    {
        Mage::register('location_data', Mage::getModel('dhlocation/location'));
        $id = (int)$this->getRequest()->getParam('id');

        if (!$id && $this->getRequest()->getParam('location_id')) {
            $id = (int)$this->getRequest()->getParam('location_id');
        }

        if ($id) {
            Mage::registry('location_data')->load($id);
        }
    }

    /**
     * Save Hours Action.
     *
     * @return void|Zend_Controller_Response_Abstract
     */
    public function saveAction()
    {
        if (!$this->getRequest()->isAjax()) {
            $this->_forward('noRoute');
            return;
        }

        $this->_initLocation();

        $postData = $this->getRequest()->getPost();

        if ($postData && Mage::registry('location_data')->getId()) {
            try {
                $id = (int)$this->getRequest()->getParam('id');

                $model = Mage::getModel("dhlocation/hour")
                    ->addData($postData)
                    ->setId($this->getRequest()->getParam("id"))
                    ->save();

                $this->_getSession()->addSuccess(Mage::helper('core')->__('Opening hour was successfully added'));
                $this->_initLayoutMessages('adminhtml/session');
                $result['messages']  = $this->getLayout()->getMessagesBlock()->getGroupedHtml();
            } catch (Mage_Core_Exception $e) {
                $result['error'] = $e->getMessage();
            } catch (Exception $e) {
                $result['error'] = Mage::helper('dhlocation')->__('An error occurred.');
                Mage::logException($e);
            }
        }

        return $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
    }

    /**
     * Mass delete from hours grid.
     */
    public function massRemoveAction()
    {
        $ids = $this->getRequest()->getPost('hour_ids', array());

        if (is_array($ids)) {
            try {
                $collection = Mage::getModel('dhlocation/hour')->getCollection()
                    ->addFieldToFilter('id', array('in' => $ids));

                foreach ($collection as $hour) {
                    $hour->delete();
                }
            } catch (Exception $e) {
                $result['error'] = Mage::helper('dhlocation')->__('An error occurred.');
                Mage::logException($e);
            }
        }
    }

    /**
     * Grid action for hours.
     *
     * @return Zend_Controller_Response_Abstract
     */
    public function gridAction()
    {
        $this->_initLocation();

        $this->loadLayout();
        return $this->getResponse()->setBody(
            $this->getLayout()->createBlock('dhlocation/adminhtml_location_edit_tab_hour_grid')->toHtml()
        );
    }

    /**
     * Check acl permission for location.
     *
     * @return mixed
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/dhlocation');
    }
}
