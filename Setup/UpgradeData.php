<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-12-26
 * Time: 14:07
 */

namespace Vaimo\ExtensionAttributes\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\ConfigFactory;
use Magento\Customer\Api\AddressMetadataInterface;

class UpgradeData implements UpgradeDataInterface
{
    const CUSTOM_ATTRIBUTE_CODE = 'custom_customer_attribute';
    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;
    /**
     * @var ConfigFactory
     */
    private $configFactory;

    /**
     * UpgradeData constructor.
     *
     * @param EavSetupFactory $eavSetupFactory
     * @param ConfigFactory $configFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        ConfigFactory $configFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->configFactory = $configFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.0.4', '<')) {
            $eavSetup = $this->eavSetupFactory->create();
            $eavConfig = $this->configFactory->create();
            $eavSetup->addAttribute(
                AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
                self::CUSTOM_ATTRIBUTE_CODE,
                [
                    'label' => 'Custom_Customer',
                    'input' => 'text',
                    'visible' => true,
                    'required' => false,
                    'position' => 150,
                    'sort_order' => 150,
                    'system' => false
                ]
            );
            $customAttribute = $eavConfig->getAttribute(
                AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
                self::CUSTOM_ATTRIBUTE_CODE
            );
            $customAttribute->setData(
                'used_in_forms',
                [
                    'adminhtml_customer_address',
                    'customer_address_edit',
                    'customer_register_address'
                ]
            );
            $customAttribute->save();
        }
        $setup->endSetup();
    }
}
