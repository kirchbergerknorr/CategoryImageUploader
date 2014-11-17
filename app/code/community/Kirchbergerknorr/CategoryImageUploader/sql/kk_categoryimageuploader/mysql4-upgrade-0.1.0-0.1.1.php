<?php
/**
 * Installer
 *
 * @category    Kirchbergerknorr
 * @package     Kirchbergerknorr
 * @author      Aleksey Razbakov <ar@kirchbergerknorr.de>
 * @copyright   Copyright (c) 2014 kirchbergerknorr GmbH (http://www.kirchbergerknorr.de)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/* @var $installer Mage_Sales_Model_Entity_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("
    UPDATE `{$installer->getTable('eav/attribute')}`
    SET `backend_model` = 'categoryimageuploader/category_attribute_backend_image'
    WHERE `backend_model` = 'catalog/category_attribute_backend_image'"
);

$installer->endSetup();
