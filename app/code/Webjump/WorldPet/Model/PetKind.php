<?php

namespace Webjump\WorldPet\Model;

use Webjump\WorldPet\Model\ResourceModel\PetKind as ResourceModel;
use Magento\Framework\Model\AbstractExtensibleModel;
use Webjump\WorldPet\Api\Data\PetKindInterface;

class PetKind extends AbstractExtensibleModel implements PetKindInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function getPetKindEntityId() : int
    {
        return $this->getData(self::ENTITY_ID);
    }

    public function getPetKindName(): string
    {
        return $this->getData(self::PET_KIND_NAME);
    }

    public function getPetKindDescription(): string
    {
        return $this->getData(self::PET_KIND_DESCRIPTION);
    }

    public function setPetKindEntityId($entityId): void
    {
        $this->setData(self::ENTITY_ID, $entityId);
    }

    public function setPetKindName($name): void
    {
        $this->setData(self::PET_KIND_NAME, $name);
    }

    public function setPetKindDescription($description): void
    {
        $this->setData(self::PET_KIND_DESCRIPTION, $description);
    }
}
