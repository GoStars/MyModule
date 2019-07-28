<?php
    namespace Magefan\MyModule\Controller\Adminhtml\GreetingMessage;

    use Magefan\MyModule\Controller\Adminhtml\GreetingMessage;
    use Magento\Backend\App\Action\Context;
    use Magento\Framework\Registry;
    use Magento\Backend\Model\View\Result\ForwardFactory;

    class NewAction extends GreetingMessage
    {
        /**
         * @var ForwardFactory
         */
        protected $resultForwardFactory;

        /**
         * @param Context $context
         * @param Registry $coreRegistry
         * @param ForwardFactory $resultForwardFactory
         */
        public function __construct(
            Context $context,
            Registry $coreRegistry,
            ForwardFactory $resultForwardFactory
        ) {
            $this->resultForwardFactory = $resultForwardFactory;
            parent::__construct($context, $coreRegistry);
        }

        /**
         * Create new item
         *
         * @return \Magento\Framework\Controller\ResultInterface
         */
        public function execute()
        {
            /** @var \Magento\Framework\Controller\Result\Forward $resultForward */
            $resultForward = $this->resultForwardFactory->create();
            
            return $resultForward->forward('edit');
        }
    }