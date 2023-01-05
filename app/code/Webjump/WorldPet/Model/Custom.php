<?php

namespace Webjump\WorldPet\Model;

use Magento\Framework\Model\AbstractModel;

class Custom extends AbstractModel
{
    const CACHE_TAG = 'entity_id';

    protected function _construct()
    {
        $this->_init('Webjump\WorldPet\Model\ResourceModel\Custom');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
