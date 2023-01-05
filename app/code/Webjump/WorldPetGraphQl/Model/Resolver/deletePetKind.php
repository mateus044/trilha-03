<?php

namespace Webjump\WorldPetGraphQl\Model\Resolver;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Webjump\WorldPet\Model\PetKindRepository;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Psr\Log\LoggerInterface;

class deletePetKind implements ResolverInterface
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
            $petKind = $this->validPetArgs($args);
            $responseDelete = $this->deletePetKind($petKind);
            return $responseDelete;
        }catch (\Exception $e) {
            $this->logger->error($e);
            return null;
        }
    }

    /**
     * @param array $args
     * @return int
     * @throws GraphQlInputException
     */
    public function validPetArgs(array $args)
    {
        if (!isset($args['entity_id'])) {
            throw new GraphQlInputException(__( 'Please provide a valid entity_id'));
        }

        if (!is_integer($args['entity_id'])) {
            throw new GraphQlInputException(__( 'Please entity_id must be integer'));
        }

        return $args['entity_id'];
    }

    /**
     * @param int $entity_id
     * @return string[]
     * @throws GraphQlInputException
     */
    public function deletePetKind(int $entity_id)
    {
        $delete = $this->petKindRepository->deletePetKind($entity_id);
        if(!$delete) {
            throw new GraphQlInputException(__( 'PetKind does not exist'));
        }
        return ['response' => "PetKind deleted"];
    }
}
