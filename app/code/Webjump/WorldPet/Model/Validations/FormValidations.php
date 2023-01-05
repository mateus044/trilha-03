<?php

namespace Webjump\WorldPet\Model\Validations;
use Exception;
use Webjump\WorldPet\Helper\ConstMessage\ConstMessage;

class FormValidations
{
    /**
     * @param array $petKind
     * @return mixed
     * @throws Exception
     */
    public function validFormForGetEntityId(array $petKind)
    {
        if(!isset($petKind['entity_id'])){
            throw new Exception(ConstMessage::ENTITY_ID_NOT_FOUND,404);
        }

        if(!is_integer($petKind['entity_id'])){
            throw new Exception(ConstMessage::ONLY_INTEGER,404);
        }

        return $petKind['entity_id'];
    }

    /**
     * @param array $petKind
     * @return array
     * @throws Exception
     */
    public function validFormForSavePet(array $petKind)
    {
        if(!isset($petKind['pet_kind_name'])){
            throw new Exception(ConstMessage::FIELD_REQUIRED,404);
        }

        if(!isset($petKind['pet_kind_description'])){
            throw new Exception(ConstMessage::FIELD_REQUIRED,404);
        }

        if(!is_string($petKind['pet_kind_name'])){
            throw new Exception(ConstMessage::ONLY_STRING,404);
        }

        if(!is_string($petKind['pet_kind_description'])){
            throw new Exception(ConstMessage::ONLY_STRING,404);
        }

        return $petKind;
    }

    /**
     * @param $petKind
     * @return array
     * @throws Exception
     */
    public function validFormForUpdatePet($petKind)
    {
        if(!isset($petKind['entity_id'])){
            throw new Exception(ConstMessage::ENTITY_ID_NOT_FOUND,404);
        }

        if(!is_integer($petKind['entity_id'])){
            throw new Exception(ConstMessage::ONLY_INTEGER,404);
        }

        if(!isset($petKind['pet_kind_name'])){
            throw new Exception(ConstMessage::FIELD_REQUIRED,404);
        }

        if(!isset($petKind['pet_kind_description'])){
            throw new Exception(ConstMessage::FIELD_REQUIRED,404);
        }

        if(!is_string($petKind['pet_kind_name'])){
            throw new Exception(ConstMessage::ONLY_STRING,404);
        }

        if(!is_string($petKind['pet_kind_description'])){
            throw new Exception(ConstMessage::ONLY_STRING,404);
        }

        return $petKind;
    }
}
