<?php
    namespace Magefan\MyModule\Controller\Page;

    use Magento\Framework\App\Action\Action;
    use Magento\Framework\App\Action\Context;
    use Magento\Framework\View\Result\PageFactory;
    use Magento\Framework\DataObject;
    
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
            // Event
            $textDisplay = new DataObject(['text' => 'Magefan']);
            $this->_eventManager->dispatch('magefan_mymodule_display_text', ['mf_text' => $textDisplay]);
            echo $textDisplay->getText();

            // Plugin
            $this->setTitle('Welcome');
            echo $this->getTitle();

            return $this->_pageFactory->create();
        }   
    }
