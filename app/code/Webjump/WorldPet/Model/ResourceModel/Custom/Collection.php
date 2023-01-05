<?php

namespace Webjump\WorldPet\Model\ResourceModel\Custom;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Webjump\WorldPet\Model\Custom','Webjump\WorldPet\Model\ResourceModel\Custom');
    }
}
