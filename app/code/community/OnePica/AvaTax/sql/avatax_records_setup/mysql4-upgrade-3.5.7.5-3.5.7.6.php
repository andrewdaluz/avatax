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

/** @var \Mage_Core_Model_Resource_Setup $installer */
$installer = $this;
$installer->startSetup();
/** @var \Varien_Db_Adapter_Pdo_Mysql $conn */
$conn = $installer->getConnection();

$table = $this->getTable('avatax_records/unit_of_measurement');

if ($conn->showTableStatus($table) !== false) {
    /** @var OnePica_AvaTax_Model_Records_Mysql4_UnitOfMeasurement_Collection $collection */
    $collection = Mage::getModel('avatax_records/unitOfMeasurement')->getCollection();
    $collection->load();

    if ($collection->count() === 0) {
        /** @var Mage_Core_Model_Store $storeDefault */
        $storeDefault = Mage::app()->getStore('default');
        /** @var Mage_Adminhtml_Helper_Data $helper */
        $helper = Mage::helper('adminhtml');

        // no United States of America, Liberia, Myanmar
        $allCountriesExceptFew = 'AD,AE,AF,AG,AI,AL,AM,AN,AO,AQ,AR,AS,AT,AU,AW,AX,AZ,BA,BB,BD,BE,BF,BG,BH,BI,BJ,BL,BM,BN,BO,BR,BS,BT,BV,BW,BY,BZ,CA,CC,CD,CF,CG,CH,CI,CK,CL,CM,CN,CO,CR,CU,CV,CX,CY,CZ,DE,DJ,DK,DM,DO,DZ,EC,EE,EG,EH,ER,ES,ET,FI,FJ,FK,FM,FO,FR,GA,GB,GD,GE,GF,GG,GH,GI,GL,GM,GN,GP,GQ,GR,GS,GT,GU,GW,GY,HK,HM,HN,HR,HT,HU,ID,IE,IL,IM,IN,IO,IQ,IR,IS,IT,JE,JM,JO,JP,KE,KG,KH,KI,KM,KN,KP,KR,KW,KY,KZ,LA,LB,LC,LI,LK,LS,LT,LU,LV,LY,MA,MC,MD,ME,MF,MG,MH,MK,ML,MN,MO,MP,MQ,MR,MS,MT,MU,MV,MW,MX,MY,MZ,NA,NC,NE,NF,NG,NI,NL,NO,NP,NR,NU,NZ,OM,PA,PE,PF,PG,PH,PK,PL,PM,PN,PR,PS,PT,PW,PY,QA,RE,RO,RS,RU,RW,SA,SB,SC,SD,SE,SG,SH,SI,SJ,SK,SL,SM,SN,SO,SR,ST,SV,SY,SZ,TC,TD,TF,TG,TH,TJ,TK,TL,TM,TN,TO,TR,TT,TV,TW,TZ,UA,UG,UM,UY,UZ,VA,VC,VE,VG,VI,VN,VU,WF,WS,YE,YT,ZA,ZM,ZW';

        // add Kilogram
        {
            /** @var $unit OnePica_AvaTax_Model_Records_UnitOfMeasurement */
            $unit = Mage::getModel('avatax_records/unitOfMeasurement');
            $unit->setStoreId($storeDefault->getId());
            $unit->setAvalaraCode('kg');
            $unit->setDescription($helper->__('Kilogram'));
            $unit->setCountryList($allCountriesExceptFew);

            $collection->addItem($unit);
        }

        // add Gram
        {
            /** @var $unit OnePica_AvaTax_Model_Records_UnitOfMeasurement */
            $unit = Mage::getModel('avatax_records/unitOfMeasurement');
            $unit->setStoreId($storeDefault->getId());
            $unit->setAvalaraCode('g');
            $unit->setDescription($helper->__('Gram'));
            $unit->setCountryList($allCountriesExceptFew);

            $collection->addItem($unit);
        }

        $collection->save();
    }
}

$installer->endSetup();
