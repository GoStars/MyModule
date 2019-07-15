<?php
    namespace Magefan\MyModule\Controller\Page;

    use Magento\Framework\App\Action\Action;
    use Magento\Framework\App\Action\Context;
    use Magento\Framework\View\Result\PageFactory;
    use Magefan\MyModule\Model\GreetingMessageFactory;

    class View extends Action {
        protected $_pageFactory;
        protected $_greetingMessageFactory;

        /**
         * @param \Magento\Framework\App\Action\Context $context
         */
        public function __construct(
            Context $context, 
            PageFactory $pageFactory,
            GreetingMessageFactory $greetingMessageFactory

        ) {
            $this->_pageFactory = $pageFactory;
            $this->_greetingMessageFactory = $greetingMessageFactory;
            parent::__construct($context);
        }

        /**
         * View  page action
        */
        public function execute() {
            $greetingMessage = $this->_greetingMessageFactory->create();
            $collection = $greetingMessage->getCollection();

            foreach ($collection as $item) {
                echo '<pre>';
                print_r($item->getData());
                echo '</pre>';
            }

            exit();

            return $this->_pageFactory->create();
        }   
    }
