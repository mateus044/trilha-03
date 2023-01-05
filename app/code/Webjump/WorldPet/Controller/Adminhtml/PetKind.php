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


namespace Webjump\WorldPet\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Message\ManagerInterface as MessageManagerInterface;
use Magento\Framework\View\Result\PageFactory;
use Webjump\WorldPet\Api\PetKindRepositoryInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Webjump\WorldPet\Model\PetKindFactory;

abstract class PetKind extends Action
{
    const ADMIN_RESOURCE = 'Webjump_WorldPet::top_level';

    /**
     * @var PetKindRepositoryInterface
     */
    protected $petKindRepository;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var MessageManagerInterface
     */
    protected $messageManager;

    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var PetKindFactory
     */
    protected $petKindFactory;


    /**
     * @param Context $context
     * @param PetKindRepositoryInterface $petKindRepository
     * @param RedirectFactory $resultRedirectFactory
     * @param ForwardFactory $resultForwardFactory
     * @param PageFactory $resultPageFactory
     * @param MessageManagerInterface $messageManager
     * @param RequestInterface $request
     * @param DataPersistorInterface $dataPersistor
     * @param PetKindFactory $petKindFactory
     */
    public function __construct(
        Context $context,
        petKindRepositoryInterface $petKindRepository,
        RedirectFactory $resultRedirectFactory,
        ForwardFactory $resultForwardFactory,
        PageFactory $resultPageFactory,
        MessageManagerInterface $messageManager,
        RequestInterface $request,
        DataPersistorInterface $dataPersistor,
        PetKindFactory $petKindFactory
    ){
        parent::__construct($context);
        $this->petKindRepository = $petKindRepository;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->messageManager = $messageManager;
        $this->request = $request;
        $this->dataPersistor = $dataPersistor;
        $this->petKindFactory = $petKindFactory;
    }

    /**
     * Init page
     *
     * @param Page $resultPage
     * @return Page
     */
    public function initPage(Page $resultPage): Page
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Webjump'), __('Webjump'))
            ->addBreadcrumb(__('WorldPet'), __('WorldPet'));
        return $resultPage;
    }

}
