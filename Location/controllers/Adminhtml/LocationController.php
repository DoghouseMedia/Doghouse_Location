<?php

class Doghouse_Location_Adminhtml_LocationController extends Mage_Adminhtml_Controller_Action
{

    protected function _initAction()
    {
        $this->loadLayout()->_setActiveMenu("cms/dhlocation");

        return $this;
    }

    public function indexAction()
    {
        $this->_title($this->__("Manage Store Locations"));
        $this->_initAction();

        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_title($this->__("New Store Location"));
        $this->_initAction();

        $model = Mage::getModel("dhlocation/location");

        Mage::register("location_data", $model);

        $this->renderLayout();
    }

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
                    } else {
                        if(!$this->getRequest()->getParam("id")) {
                            throw new Exception('An image is required!');
                        }
                        unset($post_data['image']);
                    }

                    $model = Mage::getModel("dhlocation/location")
                        ->addData($post_data)
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

    public function gridAction()
    {
        $this->loadLayout();
        return $this->getResponse()->setBody(
            $this->getLayout()->createBlock('dhlocation/adminhtml_location_grid')->toHtml()
        );
    }

}
