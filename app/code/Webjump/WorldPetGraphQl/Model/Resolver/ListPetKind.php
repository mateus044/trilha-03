<?php

namespace Webjump\WorldPetGraphQl\Model\Resolver;

use Psr\Log\LoggerInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Webjump\WorldPet\Model\PetKindRepository;

class ListPetKind implements ResolverInterface
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
            $petKinds = $this->petKindRepository->getListPetKind();
            $list = $this->mountListPetKind($petKinds);
            return ['list' => $list];

        }catch (\Exception $e) {
            $this->logger->error($e);
            return ['list' => null];
        }
    }

    /**
     * @param array $petKinds
     * @return array
     * @throws GraphQlInputException
     */
    public function mountListPetKind(array $petKinds)
    {
        if(!sizeof($petKinds)){
            throw new GraphQlInputException(__('PetKind is empty'));
        }

        $list = [];
        foreach ($petKinds as $petKind) {
            $list[] = array(
                'entity_id' => $petKind['entity_id'],
                'pet_kind_name' => $petKind['pet_kind_name'],
                'pet_kind_description' => $petKind['pet_kind_description']
            );
        }
        return $list;
    }
}
