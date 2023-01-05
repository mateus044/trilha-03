<?php
/**
 *
 *  PHP version 7
 * @author      Webjump Core Team <dev@webjump.com.br>
 * @copyright   2021 Webjump (http://www.webjump.com.br)
 * @license     http://www.webjump.com.br  Copyright
 *
 * @link        http://www.webjump.com.br
 */
declare(strict_types=1);

namespace Webjump\WorldPet\Controller\Adminhtml\Index;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Webjump\WorldPet\Controller\Adminhtml\PetKind;


class Delete extends PetKind implements HttpGetActionInterface
{

    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Webjump_WoldPet::top_level';

    /**
     * Delete action
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = (int) $this->request->getParam('entity_id');

        if ($id) {
            try {
                $this->petKindRepository->deletePetKind($id);
                $this->messageManager->addSuccessMessage(__('You deleted the PetKind.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/delete', ['entity_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a PetKind to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
