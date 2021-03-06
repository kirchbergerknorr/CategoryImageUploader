<?php
/**
 * @category    Kirchbergerknorr
 * @package     Kirchbergerknorr_CategoryImageUploader
 * @author      Aleksey Razbakov <ar@kirchbergerknorr.de>
 * @copyright   Copyright (c) 2014 kirchbergerknorr GmbH (http://www.kirchbergerknorr.de)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Workaround to avoid exception '$_FILES array is empty' when assiging
 * products to a category or creating a category with the API.
 *
 * @see http://stackoverflow.com/questions/9700611
 */
class Kirchbergerknorr_CategoryImageUploader_Model_Category_Attribute_Backend_Image
    extends Mage_Catalog_Model_Category_Attribute_Backend_Image
{
    /**
     * Save uploaded file and set its name to category
     *
     * @param Varien_Object $object
     * @return null
     */
    public function afterSave($object)
    {
        $value = $object->getData($this->getAttribute()->getName());

        if (is_array($value) && !empty($value['delete'])) {
            $object->setData($this->getAttribute()->getName(), '');
            $this->getAttribute()->getEntity()
                ->saveAttribute($object, $this->getAttribute()->getName());
            return;
        }

        if (!isset($_FILES) || count($_FILES) == 0) return;

        $path = Mage::getBaseDir('media') . DS . 'catalog' . DS . 'category' . DS;

        try {
            $uploader = new Mage_Core_Model_File_Uploader($this->getAttribute()->getName());
            $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png','svg'));
            $uploader->setAllowRenameFiles(true);
            $result = $uploader->save($path);

            $object->setData($this->getAttribute()->getName(), $result['file']);
            $this->getAttribute()->getEntity()->saveAttribute($object, $this->getAttribute()->getName());
        } catch (Exception $e) {
            if ($e->getCode() != Mage_Core_Model_File_Uploader::TMP_NAME_EMPTY) {
                Mage::logException($e);
            }
            return;
        }
    }
}
