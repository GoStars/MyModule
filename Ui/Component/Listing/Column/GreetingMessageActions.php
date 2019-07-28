<?php
    namespace Magefan\MyModule\Ui\Component\Listing\Column;

    use Magento\Framework\UrlInterface;
    use Magento\Framework\View\Element\UiComponent\ContextInterface;
    use Magento\Framework\View\Element\UiComponentFactory;
    use Magento\Ui\Component\Listing\Columns\Column;

    /**
     * Class TestActions
     */
    class GreetingMessageActions extends Column
    {
        /**
         * Url path
         */
        const URL_PATH_EDIT = 'magefan_mymodule/greetingmessage/edit';
        const URL_PATH_DELETE = 'magefan_mymodule/greetingmessage/delete';

        /**
         * @var UrlInterface
         */
        protected $urlBuilder;

        /**
         * Constructor
         *
         * @param ContextInterface $context
         * @param UiComponentFactory $uiComponentFactory
         * @param UrlInterface $urlBuilder
         * @param array $components
         * @param array $data
         */
        public function __construct(
            ContextInterface $context,
            UiComponentFactory $uiComponentFactory,
            UrlInterface $urlBuilder,
            array $components = [],
            array $data = []
        ) {
            $this->urlBuilder = $urlBuilder;
            parent::__construct($context, $uiComponentFactory, $components, $data);
        }

        /**
         * Prepare Data Source
         *
         * @param array $dataSource
         * @return array
         */
        public function prepareDataSource(array $dataSource)
        {
            if (isset($dataSource['data']['items'])) {
                foreach ($dataSource['data']['items'] as & $item) {
                    if (isset($item['greeting_id'])) {
                        $item[$this->getData('name')] = [
                            'edit' => [
                                'href' => $this->urlBuilder->getUrl(
                                    static::URL_PATH_EDIT, [
                                        'greeting_id' => $item['greeting_id']
                                    ]),
                                'label' => __('Edit')
                            ],
                            'delete' => [
                                'href' => $this->urlBuilder->getUrl(
                                    static::URL_PATH_DELETE, [
                                        'greeting_id' => $item['greeting_id']
                                    ]),
                                'label' => __('Delete'),
                                'confirm' => [
                                    'title' => __('Delete "${ $.$data.message }"'),
                                    'message' => __('Are you sure you wan\'t to delete a "${ $.$data.message }" record?')
                                ]
                            ]
                        ];
                    }
                }
            }

            return $dataSource;
        }
    }