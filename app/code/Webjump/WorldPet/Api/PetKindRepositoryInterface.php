<?php

namespace Webjump\WorldPet\Api;

use Webjump\WorldPet\Api\Data\PetKindInterface;
use Webjump\WorldPet\Model\ResourceModel\PetKind\CollectionFactory;

interface PetKindRepositoryInterface
{

    /**
     * @param int $petKind
     * @return mixed
     */
    public function getPetKind(int $petKind);

    /**
     * @return array
     */
    public function getListPetKind(): array;

    /**
     * @return array
     */
    public function savePetKind(PetKindInterface $petKind): bool;


    /**
     * @param PetKindInterface $petKind
     * @return bool
     */
    public function updatePetKind(PetKindInterface $petKind): bool;

    /**
     * @param int $petKind
     * @return mixed
     */
    public function deletePetKind(int $petKind);

}
