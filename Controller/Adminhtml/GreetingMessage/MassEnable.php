<?php
    namespace Magefan\MyModule\Controller\Adminhtml\GreetingMessage;

    use Magento\Framework\Controller\ResultFactory;
    use Magento\Backend\App\Action\Context;
    use Magento\Ui\Component\MassAction\Filter;
    use Magefan\MyModule\Model\ResourceModel\GreetingMessage\CollectionFactory;
    use Magento\Backend\App\Action;

    /**
     * Class MassEnable
     */
    class MassEnable extends Action
    {
        /**
         * @var Filter
         */
        protected $filter;

        /**
         * @var CollectionFactory
         */
        protected $collectionFactory;

        /**
         * @param Context $context
         * @param Filter $filter
         * @param CollectionFactory $collectionFactory
         */
        public function __construct(
            Context $context,
            Filter $filter,
            CollectionFactory $collectionFactory
        ) {
            $this->filter = $filter;
            $this->collectionFactory = $collectionFactory;
            parent::__construct($context);
        }

        /**
         * Execute action
         *
         * @return \Magento\Backend\Model\View\Result\Redirect
         * @throws \Magento\Framework\Exception\LocalizedException|\Exception
         */
        public function execute()
        {
            $collection = $this->filter->getCollection($this->collectionFactory->create());

            foreach ($collection as $item) {
                $item->setIsActive(true);
                $item->save();
            }

            $this->messageManager->addSuccess(__('A total of %1 record(s) have been enabled.', $collection->getSize()));

            /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            
            return $resultRedirect->setPath('*/*/');
        }
    }