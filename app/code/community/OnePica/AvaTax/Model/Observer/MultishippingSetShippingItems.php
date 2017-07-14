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

/**
 * Avatax Observer MultishippingSetShippingItems
 *
 * @category   OnePica
 * @package    OnePica_AvaTax
 * @author     OnePica Codemaster <codemaster@onepica.com>
 */
class OnePica_AvaTax_Model_Observer_MultishippingSetShippingItems
    extends OnePica_AvaTax_Model_Observer_Abstract
{
    /**
     * Validate addresses when multishipping checkout on set shipping items
     *
     * @param Varien_Event_Observer $observer
     * @return $this
     * @throws OnePica_AvaTax_Exception
     */
    public function execute(Varien_Event_Observer $observer)
    {
        // skip validation if customer wants to add new address
        if (Mage::app()->getRequest()->getParam('new_address')) {
            return $this;
        }

        /* @var $quote Mage_Sales_Model_Quote */
        $quote = $observer->getEvent()->getQuote();
        $storeId = $quote->getStoreId();

        $errors = array();
        $notice = false;

        $addresses = $quote->getAllShippingAddresses();
        $message = Mage::getStoreConfig('tax/avatax/validate_address_message', $storeId);
        foreach ($addresses as $address) {
            /* @var $address OnePica_AvaTax_Model_Sales_Quote_Address */
            if ($address->validate() !== true) {
                $errors[] = sprintf($message, $address->format('oneline'));
            }
            if ($address->getAddressNormalized()) {
                $notice = Mage::getStoreConfig('tax/avatax/multiaddress_normalize_message', $storeId);
            }
        }

        /** @var OnePica_AvaTax_Helper_Config $helperConfig */
        $helperConfig = Mage::helper('avatax/config');

        if ($helperConfig->getNormalizeAddressDisabler($storeId)) {
            $checkboxDisabler = Mage::getBlockSingleton('avatax/checkout_multishipping_address_normalization_disabler')->toHtml();
            switch ($quote->getAvataxNormalizationFlag()) {
                case 1:
                    // show checkbox in block
                    $notice = $checkboxDisabler;
                    break;
                case 0:
                    //show checkbox in notice
                    $notice = Mage::getStoreConfig('tax/avatax/multiaddress_normalize_message', $storeId) . $checkboxDisabler;
                    break;
                default:
                    break;
            }
        }

        $session = Mage::getSingleton('checkout/session');
        if ($notice) {
            $session->addNotice($notice);
        }

        if (!empty($errors)) {
            throw new OnePica_AvaTax_Exception(implode('<br />', $errors));
        }

        return $this;
    }
}
