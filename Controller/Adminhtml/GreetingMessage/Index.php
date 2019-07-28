<?php
    namespace Magefan\MyModule\Controller\Adminhtml\GreetingMessage;

    use Magefan\MyModule\Controller\Adminhtml\GreetingMessage;
    use Magento\Backend\App\Action\Context;
    use Magento\Framework\Registry;
    use Magento\Framework\View\Result\PageFactory;

    class Index extends GreetingMessage
    {
        /**
         * @var PageFactory
         */
        protected $resultPageFactory;

        /**
         * @param Context $context
         * @param Registry $coreRegistry
         * @param PageFactory $resultPageFactory
         */
        public function __construct(
            Context $context,
            Registry $coreRegistry,
            PageFactory $resultPageFactory
        ) {
            $this->resultPageFactory = $resultPageFactory;
            parent::__construct($context, $coreRegistry);
        }

        /**
         * Index action
         *
         * @return \Magento\Framework\Controller\ResultInterface
         */
        public function execute()
        {
            /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
            $resultPage = $this->resultPageFactory->create();

            $this->initPage($resultPage)->getConfig()->getTitle()->prepend(__('Items'));
            
            return $resultPage;
        }
    }