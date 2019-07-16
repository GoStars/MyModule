<?php
    namespace Magefan\MyModule\Controller\Adminhtml\GreetingMessage;

    use Magento\Backend\App\Action;
    use Magento\Backend\App\Action\Context;
    use Magento\Framework\View\Result\PageFactory;

    class Index extends Action {
        protected $resultPageFactory = false;

        public function __construct(
            Context $context,
            PageFactory $resultPageFactory
        ) {
            parent::__construct($context);
            $this->resultPageFactory = $resultPageFactory;
        }

        public function execute() {
            $resultPage = $this->resultPageFactory->create();
            $resultPage->getConfig()->getTitle()->prepend((__('Greeting Message')));

            return $resultPage;
        }
    }
