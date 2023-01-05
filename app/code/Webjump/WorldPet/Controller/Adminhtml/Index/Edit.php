<?php

namespace Webjump\WorldPet\Controller\Adminhtml\Index;

use Webjump\WorldPet\Controller\Adminhtml\PetKind;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Edit extends PetKind implements HttpGetActionInterface
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Webjump_WorldPet::top_level';

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        $id = $this->request->getParam('entity_id');
        if ($id) {
            try {
                $model = $this->petKindRepository->getPetKind($id);
                $id = $model->getData('id');
            } catch (\Exception $exception) {
                $this->messageManager->addErrorMessage(__('This PetKind no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $resultPage = $this->resultPageFactory->create();
        return $resultPage;


//        $this->initPage($resultPage)->addBreadcrumb(
//            $id ? __('Edit PetKind')  : __('New PetKind'),
//            $id ? __('Edit PetKind')  : __('New PetKind')
//        );
//
//        $resultPage->getConfig()->getTitle()->prepend(__('Update'));
//        $resultPage->getConfig()->getTitle()->prepend(
//            $id ? __('Update PetKind %1', $model->getIbgeId()) : __('Update PetKind')
//        );
//        return $resultPage;




//        $id = $this->request->getParam('entity_id');
//        if ($id) {
//            try {
//                $model = $this->petKindRepository->getPetKind($id);
//                $id = $model->getData('id');
//            } catch (\Exception $exception) {
//                $this->messageManager->addErrorMessage(__('This PetKind no longer exists.'));
//                $resultRedirect = $this->resultRedirectFactory->create();
//                return $resultRedirect->setPath('*/*/');
//            }
//        }
//
//        $resultPage = $this->resultPageFactory->create();
//        $this->initPage($resultPage)->addBreadcrumb(
//            $id ? __('Edit PetKind')  : __('New PetKind'),
//            $id ? __('Edit PetKind')  : __('New PetKind')
//        );
//
//        $resultPage->getConfig()->getTitle()->prepend(__('Update'));
//        $resultPage->getConfig()->getTitle()->prepend(
//            $id ? __('Update PetKind %1', $model->getIbgeId()) : __('Update PetKind')
//        );
//        return $resultPage;
    }
}
