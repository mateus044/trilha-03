<?php

namespace Webjump\WorldPetGraphQl\Model\Resolver;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Webjump\WorldPet\Model\PetKindRepository;
use Webjump\WorldPet\Api\Data\PetKindInterface;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Psr\Log\LoggerInterface;

class updatePetKind implements ResolverInterface
{

    private PetKindRepository $petKindRepository;

    private PetKindInterface $petKindInterface;

    private LoggerInterface $logger;

    public function __construct(PetKindRepository $petKindRepository, PetKindInterface $petKindInterface, LoggerInterface $logger)
    {
        $this->petKindRepository = $petKindRepository;
        $this->petKindInterface = $petKindInterface;
        $this->logger = $logger;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        try {
            $argsPet  = $this->validArgs($args);
            $response = $this->updatePetKind($argsPet);
            return $response;

        }catch (\Exception $e) {
            $this->logger->error($e);
            return null;
        }
    }

    /**
     * @param array $args
     * @return array
     * @throws GraphQlInputException
     */
    public function validArgs(array $args)
    {
        if (!isset($args['entity_id'])) {
            throw new GraphQlInputException(__( 'Please provide a valid entity_id'));
        }

        if (!is_integer($args['entity_id'])) {
            throw new GraphQlInputException(__( 'Please entity_id must be integer'));
        }

        if (!isset($args['pet_kind_name'])) {
            throw new GraphQlInputException(__( 'Please provide a valid pet_kind_name'));
        }

        if (!is_string($args['pet_kind_name'])) {
            throw new GraphQlInputException(__( 'Please pet_kind_name must be string'));
        }

        if (!isset($args['pet_kind_description'])) {
            throw new GraphQlInputException(__( 'Please provide a valid pet_kind_description'));
        }

        if (!is_string($args['pet_kind_description'])) {
            throw new GraphQlInputException(__( 'Please provide a valid pet_kind_description'));
        }

        return $args;
    }

    /**
     * @param array $petArgs
     * @return array
     * @throws GraphQlInputException
     */
    public function updatePetKind(array $petArgs)
    {
        $this->petKindInterface->setPetKindEntityId($petArgs['entity_id']);
        $this->petKindInterface->setPetKindName($petArgs['pet_kind_name']);
        $this->petKindInterface->setPetKindDescription($petArgs['pet_kind_description']);
        $petKind = $this->petKindInterface;

        $resul = $this->petKindRepository->updatePetKind($petKind);
        if(!$resul) {
            throw new GraphQlInputException(__( 'PetKind does not exist'));
        }

        $petkind = [
            'entity_id' => $this->petKindInterface->getPetKindEntityId(),
            'pet_kind_name' => $this->petKindInterface->getPetKindName(),
            'pet_kind_description' => $this->petKindInterface->getPetKindDescription()];

        return $petkind;
    }
}
