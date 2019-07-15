<?php
    namespace Magefan\MyModule\Controller\Page;

    use Magento\Framework\App\Action\Action;
    use Magento\Framework\App\Action\Context;
    use Magento\Framework\View\Result\PageFactory;
    
    class View extends Action {
        protected $_pageFactory;
        
        /**
         * @param \Magento\Framework\App\Action\Context $context
         */
        public function __construct(
            Context $context, 
            PageFactory $pageFactory
        ) {
            $this->_pageFactory = $pageFactory;
            parent::__construct($context);
        }

        /**
         * View  page action
        */
        public function execute() {
            return $this->_pageFactory->create();
        }   
    }
