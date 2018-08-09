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
 * @copyright  Copyright (c) 2009 One Pica, Inc.
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

/**
 * Unit Of Measurement model
 *
 * @method int getId()
 * @method int getStoreId()
 * @method $this setStoreId(int $storeId)
 * @method string getAvalaraCode()
 * @method $this setAvalaraCode(string $code)
 * @method string getAvalaraMeasurementType()
 * @method $this setAvalaraMeasurementType(string $measurementType)
 * @method string getDescription()
 * @method $this setDescription(string $description)
 * @method string getCountryList() // ISO 2 Code list comma separated
 * @method $this setCountryList(string $countryCodes) // ISO 2 Code list comma separated
 * @method OnePica_AvaTax_Model_Records_Mysql4_UnitOfMeasurement getResource()
 * @method OnePica_AvaTax_Model_Records_Mysql4_UnitOfMeasurement_Collection getCollection()
 *
 * @category   OnePica
 * @package    OnePica_AvaTax
 * @author     OnePica Codemaster <codemaster@onepica.com>
 */
class OnePica_AvaTax_Model_Records_UnitOfMeasurement extends Mage_Core_Model_Abstract
{
    /**
     * Event Handler Prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'avatax_records_unitofmeasurement';

    /**
     * Internal constructor
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('avatax_records/unitOfMeasurement');
    }

    /**
     * Get config helper
     *
     * @return OnePica_AvaTax_Helper_Config
     */
    protected function _getConfigHelper()
    {
        return Mage::helper('avatax/config');
    }
}
