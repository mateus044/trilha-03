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
namespace Webjump\WorldPet\Ui\Component\Listing\Column;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class PetKindActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    const URL_PATH_DELETE = 'uiexample/index/delete/';
    const URL_PATH_EDIT = 'uiexample/index/edit/';

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * IbgeActions constructor.
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface   $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface       $urlBuilder,
        array              $components = [],
        array              $data = []
    )
    {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['entity_id'])) {
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(static::URL_PATH_EDIT,['entity_id' => $item['entity_id']]),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(static::URL_PATH_DELETE,['entity_id' => $item['entity_id']]),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __("Delete PetKind: {$item['entity_id']}"),
                                'message' => __('Are you sure you wan\'t to delete this code PETKIND?')
                            ]
                        ]
                    ];
                }
            }
        }
        return $dataSource;
    }
}

