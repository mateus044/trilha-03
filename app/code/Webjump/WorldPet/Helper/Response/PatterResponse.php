<?php

namespace Webjump\WorldPet\Helper\Response;

class PatterResponse
{
    /**
     * @param $entity
     * @return array
     */
    public function responseGetPetKind($entity)
    {
        $entity = $entity->getData();
        $petKind = [
            'id' => $entity['entity_id'],
            'name' => $entity['pet_kind_name'],
            'description' => $entity['pet_kind_description']
        ];
        return $petKind;
    }


    public function mountPets($pets)
    {
        $response = [];
        foreach ($pets as $pet) {
            $response[] = array(
                'id' => $pet->getData('entity_id'),
                'name' => $pet->getData('pet_kind_name'),
                'description' => $pet->getData('pet_kind_description'),
            );
        }
        return $response;
    }
}
