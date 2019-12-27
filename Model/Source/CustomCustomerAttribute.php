<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-12-26
 * Time: 14:56
 */

namespace Vaimo\ExtensionAttributes\Model\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class CustomCustomerAttribute
 * @package Vaimo\ExtensionAttributes\Model\Source
 */
class CustomCustomerAttribute implements ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => 'country',
                'label' => __('Country')
            ],
            [
                'value' => 'City',
                'label' => __('City')
            ],
            [
                'value' => 'Town',
                'label' => __('Town')
            ]
        ];
    }
}
