<?php
    namespace Magefan\MyModule\Controller\Page;

    use Magento\Framework\App\Action\Action;
    use Magento\Framework\App\Action\Context;
    use Magento\Framework\View\Result\PageFactory;
    
    class View extends Action {
        protected $_pageFactory;

        protected $title;
        
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

        public function setTitle($title) {
            return $this->title = $title;
        }

        public function getTitle() {
            return $this->title;
        }

        /**
         * View  page action
        */
        public function execute() {
            echo $this->setTitle('Welcome');

            echo $this->getTitle();

            exit();

            return $this->_pageFactory->create();
        }   
    }
