<?php

namespace Webjump\WorldPet\Block\Adminhtml\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Edit implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Update'),
            'class' => 'update primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'update']],
                'form-role' => 'update',
            ],
            'sort_order' => 90,
        ];
    }
}
