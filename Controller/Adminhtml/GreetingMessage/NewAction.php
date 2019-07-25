<?php
    namespace Magefan\MyModule\Controller\Adminhtml\GreetingMessage;

    use Magento\Backend\App\Action;
    use Magento\Backend\App\Action\Context;
    use Magento\Backend\Model\View\Result\ForwardFactory;

    class NewAction extends Action {
        /**
         * @var \Magento\Backend\Model\View\Result\Forward
         */
        protected $resultForwardFactory;
        
        /**
         * @param \Magento\Backend\App\Action\Context $context
         * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
         */
        public function __construct(
            Context $context,
            ForwardFactory $resultForwardFactory
        ) {
            $this->resultForwardFactory = $resultForwardFactory;
            parent::__construct($context);
        }

        /**
         * Forward to edit
         *
         * @return \Magento\Backend\Model\View\Result\Forward
         */
        public function execute() {
            /** 
             * @var \Magento\Backend\Model\View\Result\Forward $resultForward
             */
            $resultForward = $this->resultForwardFactory->create();
            
            return $resultForward->forward('edit');
        }

        /**
         * {@inheritdoc}
         */
        protected function _isAllowed() {
            return true;
        }
    }