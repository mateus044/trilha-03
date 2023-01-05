<?php

namespace Webjump\WorldPet\Controller\Adminhtml\Index;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\App\Action\Context;
use Webjump\WorldPet\Model\PetKindRepository;
use Webjump\WorldPet\Api\Data\PetKindInterface;
use Exception;
class Save extends \Magento\Backend\App\Action
{

    private PetKindRepository $petKindRepository;
    private Redirect $resultRedirect;
    private PetKindInterface $petKindInterface;

    public function __construct(Context $context, PetKindInterface $petKindInterface, PetKindRepository $petKindRepository)
    {
        parent::__construct($context);
        $this->petKindInterface = $petKindInterface;
        $this->petKindRepository = $petKindRepository;
    }

    public function execute()
    {
        try {
            $data = $this->getRequest()->getPostValue();
            $args = $this->validArgs($data);
            $pet  = $this->preparePetKindInterface($args);
            $this->savePetKind($pet);
        }catch (Exception $e) {
            $this->messageManager->addErrorMessage( __('Error to save PetKind' . ':' . $e->getMessage()));
            $this->_redirect('*/*/index');
        }
    }

    private function validArgs(array $args): array
    {
        if (!isset($args['pet_kind_name'])) {
            throw new Exception('Please provide a valid Name');
        }

        if (!isset($args['pet_kind_description'])) {
            throw new Exception( 'Please provide a valid Description');
        }

        return $args;
    }

    private function preparePetKindInterface(array $args): PetKindInterface
    {
        $this->petKindInterface->setPetKindName($args['pet_kind_name']);
        $this->petKindInterface->setPetKindDescription($args['pet_kind_description']);
        return $this->petKindInterface;
    }

    private function savePetKind(PetKindInterface $petKind)
    {
        $this->petKindRepository->savePetKind($petKind);
        $this->messageManager->addSuccess( __('Save PetKind Successfully !') );
        $this->_redirect('*/*/index');
    }
}
