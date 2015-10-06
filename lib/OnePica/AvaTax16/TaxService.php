<?php
/**
 * OnePica
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to codemaster@onepica.com so we can send you a copy immediately.
 *
 * @category  OnePica
 * @package   OnePica_AvaTax
 * @copyright Copyright (c) 2015 One Pica, Inc. (http://www.onepica.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Class OnePica_AvaTax16_TaxService
 */
class OnePica_AvaTax16_TaxService extends OnePica_AvaTax16_ResourceAbstract
{
    /**
     * Config
     *
     * @var OnePica_AvaTax16_Config
     */
    protected $_config;

    /**
     * Construct
     *
     * @param OnePica_AvaTax16_Config $config
     */
    public function __construct($config)
    {
        $this->_config = $config;
    }

    /**
     * Get config
     *
     * @return OnePica_AvaTax16_Config
     */
    public function getConfig()
    {
        return $this->_config;
    }

    /**
     * Create Transaction
     *
     * @param string $type
     * @return mixed $taxResource
     */
    protected function _getTaxResource($type)
    {
        $config  = $this->getConfig();
        $taxResource = null;
        switch ($type) {
            case 'calculation':
                $taxResource = new OnePica_AvaTax16_Calculation($config);
                break;
            case 'transaction':
                $taxResource = new OnePica_AvaTax16_Transaction($config);
                break;
            case 'addressResolution':
                $taxResource = new OnePica_AvaTax16_AddressResolution($config);
                break;
        }
        return $taxResource;
    }

    /**
     * Create Transaction
     *
     * @param OnePica_AvaTax16_Document_Request $documentRequest
     * @return OnePica_AvaTax16_Document_Response $documentResponse
     */
    public function createCalculation($documentRequest)
    {
        $calculationResource = $this->_getTaxResource('calculation');
        $documentResponse = $calculationResource->createCalculation($documentRequest);
        return $documentResponse;
    }

    /**
     * Get Calculation
     *
     * @param string $transactionType
     * @param string $documentCode
     * @return OnePica_AvaTax16_Document_Response $documentResponse
     */
    public function getCalculation($transactionType, $documentCode)
    {
        $calculationResource = $this->_getTaxResource('calculation');
        $documentResponse = $calculationResource->getCalculation($transactionType, $documentCode);
        return $documentResponse;
    }

    /**
     * Get List Of Calculations
     *
     * @param string $transactionType
     * @param int $limit
     * @param string $startDate
     * @param string $endDate
     * @param string $startCode (not implemented)
     * @return OnePica_AvaTax16_Calculation_ListResponse $calculationListResponse
     */
    public function getListOfCalculations($transactionType, $limit = null, $startDate = null, $endDate = null,
        $startCode = null)
    {
        $calculationResource = $this->_getTaxResource('calculation');
        $calculationListResponse = $calculationResource->getListOfCalculations($transactionType, $limit, $startDate,
            $endDate, $startCode);
        return $calculationListResponse;
    }

    /**
     * Create Transaction
     *
     * @param OnePica_AvaTax16_Document_Request $documentRequest
     * @return OnePica_AvaTax16_Document_Response $documentResponse
     */
    public function createTransaction($documentRequest)
    {
        $transactionResource = $this->_getTaxResource('transaction');
        $documentResponse = $transactionResource->createTransaction($documentRequest);
        return $documentResponse;
    }

    /**
     * Create Transaction from Calculation
     *
     * @param string $transactionType
     * @param string $documentCode
     * @param bool $recalculate
     * @param string $comment
     * @return OnePica_AvaTax16_Document_Response $documentResponse
     */
    public function createTransactionFromCalculation($transactionType, $documentCode, $recalculate = null,
        $comment = null)
    {
        $transactionResource = $this->_getTaxResource('transaction');
        $documentResponse = $transactionResource->createTransactionFromCalculation($transactionType, $documentCode,
            $recalculate, $comment);
        return $documentResponse;
    }
}