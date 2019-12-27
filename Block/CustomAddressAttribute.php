<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-12-26
 * Time: 17:01
 */

namespace Vaimo\ExtensionAttributes\Block;

use Magento\Framework\View\Element\Template;

/**
 * Class CustomAddressAttribute
 * @package Vaimo\ExtensionAttributes\Block
 */
class CustomAddressAttribute extends Template
{
    const ADDITONAL_ATTRIBUTE_CODE = 'custom_customer_attribute';
    /**
     * @var string
     */
    protected $_template = 'Vaimo_ExtensionAttributes::CustomAddressAttribute.phtml';
    /**
     * @var string
     */
    private $attributeValue;

    /**
     * @return string
     */
    public function getCustomAttributeValue()
    {

        return $this->attributeValue;
    }

    /**
     * @param $string
     */
    public function setCustomAttributeValue($string)
    {
        $this->attributeValue = $string;
    }

    /**
     * @return string
     */
    public function getCustomCustomerCode()
    {
        return self::ADDITONAL_ATTRIBUTE_CODE;
    }
}
