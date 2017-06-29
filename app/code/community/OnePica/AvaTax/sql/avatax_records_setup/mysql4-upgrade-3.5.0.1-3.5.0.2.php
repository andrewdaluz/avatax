<?php
/**
 * OnePica_AvaTax
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0), a
 * copy of which is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   OnePica
 * @package    OnePica_AvaTax
 * @author     OnePica Codemaster <codemaster@onepica.com>
 * @copyright  Copyright (c) 2015 One Pica, Inc.
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

/** @var $this Mage_Core_Model_Resource_Setup */

$installer = $this;
$installer->startSetup();

$setup = Mage::getModel('sales/resource_setup', 'core_setup');

$attributeCode = 'avatax_normalization_flag';

$setup->addAttribute(
    'quote', $attributeCode, array(
    'label'            => 'Avatax Normalization Flag',
    'type'             => 'int',
    'input'            => 'text',
    'visible'          => 0,
    'required'         => 0,
    'user_defined'     => 0,
    'visible_on_front' => 0,
    'position'         => 200,
    'sort_order'       => 200)
);

$installer->endSetup();
