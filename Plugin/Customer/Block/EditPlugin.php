<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-12-26
 * Time: 17:10
 */

namespace Vaimo\ExtensionAttributes\Plugin\Customer\Block;

use Magento\Customer\Block\Address\Edit;
use Vaimo\ExtensionAttributes\Block\CustomAddressAttributeFactory;

/**
 * Class EditPlugin
 * @package Vaimo\ExtensionAttributes\Plugin\Customer\Block
 */
class EditPlugin
{
    /**
     * @var CustomAddressAttributeFactory
     */
    private $additionalAdressInputFactory;

    /**
     * EditPlugin constructor.
     *
     * @param CustomAddressAttributeFactory $customAddressAttributeFactory
     */
    public function __construct(CustomAddressAttributeFactory $customAddressAttributeFactory)
    {
        $this->additionalAdressInputFactory = $customAddressAttributeFactory;
    }

    /**
     * @param Edit $object
     * @param $result
     *
     * @return string
     */
    public function aftergetNameBlockHtml(Edit $object, $result)
    {
        $customAtributeValue = $object->getCustomer()
            ->getAddresses()[0]->getCustomAttribute('custom_customer_attribute')->getValue();
        $additionalBlock = $this->additionalAdressInputFactory->create();
        $additionalBlock->setCustomAttributeValue($customAtributeValue);
        $newResult = $result.$this->additionalAdressInputFactory->create()->toHtml();
        return $newResult;
    }
}
