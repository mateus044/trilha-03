<?php

namespace Webjump\WorldPet\Api;

use Webjump\WorldPet\Api\Data\PetKindInterface;

interface PetKindManagerInterface
{
    /**
     * @return mixed
     */
    public function managePetSearch(PetKindInterface $petKind);

    /**
     * @return array
     */
    public function manageGetListPetKind();


    /**
     * @param PetKindInterface $petKind
     * @return mixed
     */
    public function manageSavePetKind(PetKindInterface $petKind): array;


    /**
     * @param PetKindInterface $petKind
     * @return array
     */
    public function manageUpdatePetKind(PetKindInterface $petKind): array;

    /**
     * @return mixed
     */
    public function deletePetKind(PetKindInterface $petKind);

}
