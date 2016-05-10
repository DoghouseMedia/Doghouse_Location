<?php
/**
 * Doghouse_Location_Helper_Data
 *
 * @category  Doghouse
 * @package   Doghouse_Location
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Location/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Location
 */
class Doghouse_Location_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     * Image lcoation
     */
    const MEDIA_DIR = 'dhlocation/';

    /**
     * With http:// and everything
     * @return [string] url
     */
    public function getImageUrl()
    {
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . self::MEDIA_DIR;
    }

    /**
     * Get the directory, so /media/location/
     * @return [string] uri
     */
    public function getFullImagesDir()
    {
        return Mage::getBaseDir('media') . DS . self::MEDIA_DIR;
    }

    /**
     * Does some saving action
     * @param  [type] $name name of the input field
     * @return [string | false] filename or false on exception
     */
    public function saveImage($name)
    {
        $path = $this->getFullImagesDir();

        try {
            $uploader = Mage::getModel('core/file_uploader', $name);
            $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
            $uploader->setAllowRenameFiles(true);
            $result = $uploader->save($path);

            return $result['file'];
        } catch (Exception $e) {
            if ($e->getCode() != Mage_Core_Model_File_Uploader::TMP_NAME_EMPTY) {
                Mage::logException($e);
            }

            return;
        }
    }

    /**
     * Formats a nicely formatted Image url
     * @param  Doghouse_Location_Model_Item $item [description]
     * @return [String] url
     */
    public function getImage(Doghouse_Location_Model_Location $item)
    {
        return $this->getImageUrl() . $item->getImage();
    }
}
