<?php
    namespace Magefan\MyModule\Controller\Adminhtml\GreetingMessage;

    use Magento\Backend\App\Action;
    use Magento\Backend\App\Action\Context;
    use Magento\Framework\View\Result\PageFactory;

    class Index extends Action {
        /**
         * @var PageFactory
         */
        protected $resultPageFactory;

        /**
         * @param Context $context
         * @param PageFactory $resultPageFactory
         */
        public function __construct(
            Context $context,
            PageFactory $resultPageFactory
        ) {
            parent::__construct($context);
            $this->resultPageFactory = $resultPageFactory;
        }

        /**
         * Index action
         *
         * @return void
         */
        public function execute() {
            /** 
             * @var \Magento\Backend\Model\View\Result\Page $resultPage
             */
            $resultPage = $this->resultPageFactory->create();
            $resultPage->setActiveMenu('Magefan_MyModule::greetingmessage');
            $resultPage->addBreadcrumb(__('CMS'), __('CMS'));
            $resultPage->addBreadcrumb(__('Manage MyModule'), __('Manage MyModule'));
            $resultPage->getConfig()->getTitle()->prepend((__('Greeting Message')));

            return $resultPage;
        }
    }
