<?php

namespace Webjump\WorldPet\Model;

use Webjump\WorldPet\Api\Data\PetKindInterface;
use Webjump\WorldPet\Api\PetKindManagerInterface;
use Webjump\WorldPet\Helper\ConstMessage\ConstMessage;
use Webjump\WorldPet\Helper\Utils\PatterReturn;
use Webjump\WorldPet\Model\Validations\FormValidations;
use Webjump\WorldPet\Helper\Response\PatterResponse;
use Exception;

class PetKindManager implements PetKindManagerInterface
{
    /**
     * @var PetKindRepository
     */
    private PetKindRepository $petKindRepository;

    /**
     * @var PatterReturn
     */
    private PatterReturn $patterReturn;

    /**
     * @var FormValidations
     */
    private FormValidations $formValidations;

    /**
     * @var PatterResponse
     */
    private  PatterResponse $patterResponse;


    public function __construct(PetKindRepository $petKindRepository, PatterReturn $patterReturn, FormValidations $formValidations, PatterResponse $patterResponse)
    {
        $this->petKindRepository = $petKindRepository;
        $this->patterReturn    = $patterReturn;
        $this->formValidations = $formValidations;
        $this->patterResponse = $patterResponse;
    }

    /**
     * @param PetKindInterface $petKind
     * @return array|mixed|null
     */
    public function managePetSearch(PetKindInterface $petKind)
    {
        try {
            $entity  = $this->formValidations->validFormForGetEntityId($petKind->getData());
            return  $this->gePetKind($entity);
        }catch (\Exception $e){
             return $this->patterReturn->messageError($e->getMessage(),500);
        }
    }

    /**
     * @return array|string
     */
    public function manageGetListPetKind()
    {
        $list = $this->getListPetKind();
        return $list;
    }

    /**
     * @param PetKindInterface $petKind
     * @return array|mixed
     */
    public function manageSavePetKind(PetKindInterface $petKind) : array
    {
        try {
            $this->formValidations->validFormForSavePet($petKind->getData());
            $this->petKindRepository->savePetKind($petKind);
            return ['data' => ConstMessage::SAVE_SUCCESS];

        }catch (\Exception $e){
            return $this->patterReturn->messageError($e->getMessage(), 500);
        }
    }

    /**
     * @param PetKindInterface $petKind
     * @return array
     */
    public function manageUpdatePetKind(PetKindInterface $petKind): array
    {
        try {
            $pet = $this->updatePetKind($petKind);
            return $pet;
        }catch (\Exception $e){
            return $this->patterReturn->messageError($e->getMessage(), 500);
        }
    }

    /**
     * @param PetKindInterface $petKind
     * @return array|mixed
     */
    public function deletePetKind(PetKindInterface $petKind)
    {
        $pet = $this->gePetKind($petKind->getData('entity_id'));
        if($pet !== 'PetNotFound'){
           $this->petKindRepository->deletePetKind($petKind->getData('entity_id'));
           return ['data' => ConstMessage::DELETED_SUCCESS];
        }
        return ['data' => $pet];
    }

    /**
     * @param int $entity
     * @return array|string
     */
    public function gePetKind(int $entity)
    {
        $entity = $this->petKindRepository->getPetKind($entity);
        if(is_null($entity)){
            return ConstMessage::PET_NOT_EXISTS;
        }

        $response = $this->patterResponse->responseGetPetKind($entity);
        return ['data' => $response];
    }

    /**
     * @return array|string
     */
    public function getListPetKind()
    {
        $pets = $this->petKindRepository->getListPetKind();
        if(empty($pets)) {
            return ConstMessage::PET_NOT_EXISTS;
        }

        $response = $this->patterResponse->mountPets($pets);
        return $response;
    }

    /**
     * @param $petKind
     * @return array
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function updatePetKind($petKind)
    {
        $petKind = $this->formValidations->validFormForUpdatePet($petKind);
        $response = $this->petKindRepository->updatePetKind($petKind);
        if($response) {
            return ['data' => ConstMessage::UPDATE_SUCCESS];
        }
        return ['data' => ConstMessage::PET_NOT_EXISTS];
    }
}
