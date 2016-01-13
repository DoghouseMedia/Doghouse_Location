<?php
/**
 * Doghouse_Location_Adminhtml_LocationController
 *
 * @category  Doghouse
 * @package   Doghouse_Location
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Location/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Location
 */
class Doghouse_Location_Adminhtml_LocationController extends Mage_Adminhtml_Controller_Action
{

    /**
     * Init the menu.
     *
     * @return $this
     */
    protected function _initAction()
    {
        $this->loadLayout()->_setActiveMenu("cms/dhlocation");

        return $this;
    }

    /**
     * Index action for locations.
     *
     * @return string
     */
    public function indexAction()
    {
        $this->_title($this->__("Manage Store Locations"));
        $this->_initAction();

        $this->renderLayout();
        return $this.
    }

    /**
     * New Locations Action.
     *
     * @return $this
     */
    public function newAction()
    {
        $this->_title($this->__("New Store Location"));
        $this->_initAction();

        $model = Mage::getModel("dhlocation/location");

        Mage::register("location_data", $model);

        $this->renderLayout();
        return $this;
    }

    /**
     * Edit Locations Action.
     */
    public function editAction()
    {
        $this->_title($this->__("Edit Store Location"));
        $this->_initAction();

        $id = $this->getRequest()->getParam("id");
        $model = Mage::getModel("dhlocation/location")->load($id);

        if ($model->getId()) {
            Mage::register("location_data", $model);

            $this->renderLayout();
        } else {
            Mage::getSingleton("adminhtml/session")->addError(Mage::helper("adminhtml")->__("Location does not exist."));
            $this->_redirect("*/*/");
        }
    }

    /**
     * Save Locations.
     */
    public function saveAction()
    {

        $post_data = $this->getRequest()->getPost();

            if ($post_data) {

                try {

                    //File upload
                    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                        if($filename = Mage::helper('dhlocation')->saveImage('image')) {
                            $post_data['image'] = $filename;
                        }
                    } elseif (isset($post_data['image']['delete']) && $post_data['image']['delete']) {
                        $post_data['image'] = null;
                    }

                    $model = Mage::getModel("dhlocation/location")
                        ->setData($post_data)
                        ->setId($this->getRequest()->getParam("id"))
                        ->save();

                    Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Location was successfully saved"));
                    Mage::getSingleton("adminhtml/session")->setLocationData(false);

                    if ($this->getRequest()->getParam("back")) {
                        $this->_redirect("*/*/edit", array("id" => $model->getId()));
                        return;
                    }
                    $this->_redirect("*/*/");
                    return;
                }
                catch (Exception $e) {
                    Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                    Mage::getSingleton("adminhtml/session")->setLocationData($this->getRequest()->getPost());
                    if($this->getRequest()->getParam("id")) {
                        $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
                    } else {
                        $this->_redirect("*/*/new");
                    }
                return;
                }

            }
            $this->_redirect("*/*/");
    }

    /**
     * Delete Locations.
     */
    public function deleteAction()
    {
            if( $this->getRequest()->getParam("id") > 0 ) {
                try {
                    $model = Mage::getModel("dhlocation/location");
                    $model->setId($this->getRequest()->getParam("id"))->delete();
                    Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Location was successfully deleted"));
                    $this->_redirect("*/*/");
                }
                catch (Exception $e) {
                    Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                    $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
                }
            }
            $this->_redirect("*/*/");
    }

    /**
     * Mass Delete on locations grid.
     */
    public function massRemoveAction()
    {
        try {
            $ids = $this->getRequest()->getPost('ids', array());
            foreach ($ids as $id) {
                  $model = Mage::getModel("dhlocation/location");
                  $model->setId($id)->delete();
            }
            Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("%s location(s) successfully removed", count($ids)));
        }
        catch (Exception $e) {
            Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
        }
        $this->_redirect('*/*/');
    }

    /**
     * Location grid.
     *
     * @return Zend_Controller_Response_Abstract
     */
    public function gridAction()
    {
        $this->loadLayout();
        return $this->getResponse()->setBody(
            $this->getLayout()->createBlock('dhlocation/adminhtml_location_grid')->toHtml()
        );
    }

    /**
     * Check acl permission for locations.
     *
     * @return mixed
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/dhlocation');
    }
}
