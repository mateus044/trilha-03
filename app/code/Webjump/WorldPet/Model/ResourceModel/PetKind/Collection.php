<?php

namespace Webjump\WorldPet\Model\ResourceModel\PetKind;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Webjump\WorldPet\Model\PetKind;
use Webjump\WorldPet\Model\ResourceModel\PetKind as PetKindResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(PetKind::class, PetKindResourceModel::class);
    }
}
