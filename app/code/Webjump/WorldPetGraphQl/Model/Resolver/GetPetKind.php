<?php

namespace Webjump\WorldPetGraphQl\Model\Resolver;

use Psr\Log\LoggerInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Webjump\WorldPet\Model\PetKindRepository;

class GetPetKind implements ResolverInterface
{

    private PetKindRepository $petKindRepository;

    private LoggerInterface $logger;

    public function __construct(PetKindRepository $petKindRepository, LoggerInterface $logger)
    {
        $this->petKindRepository = $petKindRepository;
        $this->logger = $logger;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        try {
            $petKind  = $this->getPetKind($args);
            $response = $this->mountPetKind($petKind);
            return $response;
        }catch (\Exception $e) {
            $this->logger->error($e);
            return null;
        }
    }

    /**
     * @param array $args
     * @return array|mixed|null
     * @throws GraphQlInputException
     */
    public function getPetKind(array $args)
    {
        if (!isset($args['entity_id'])) {
            throw new GraphQlInputException(__( 'Please provide a valid entity_id'));
        }

        $petKind = $this->petKindRepository->getPetKind($args['entity_id']);
        if(is_null($petKind)){
            throw new GraphQlInputException(__( 'petKind is empty'));
        }

        return $petKind->getData();
    }

    /**
     * @param array $petKind
     * @return array
     */
    public function mountPetKind(array $petKind)
    {
        $array = [
          'pet_kind_name' =>$petKind['pet_kind_name'],
          'pet_kind_description' =>$petKind['pet_kind_description']
        ];
        return $array;
    }
}
