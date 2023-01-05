<?php

namespace Webjump\WorldPet\Api\Data;

interface PetKindInterface
{

    /**
     * @const ENTITY_ID
     */
    const ENTITY_ID = 'entity_id';

    /**
     * @const PET_KIND_NAME
     */
    const PET_KIND_NAME  = 'pet_kind_name';

    /**
     * @const PET_KIND_DESCRIPTION
     */
    const PET_KIND_DESCRIPTION = 'pet_kind_description';

    /**
     * @return mixed
     */
    public function getPetKindEntityId(): int;

    /**
     * @return string
     */
    public function getPetKindName() : string;

    /**
     * @return string
     */
    public function getPetKindDescription() : string;

    /**
     * @param int $entityId
     * @return void
     */
    public function setPetKindEntityId(int $entityId) : void;

    /**
     * @param string $name
     * @return void
     */
    public function setPetKindName(string $name) : void;

    /**
     * @param string $description
     * @return void
     */
    public function setPetKindDescription(string $description) : void;
}
