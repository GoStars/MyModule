<?php
    namespace Magefan\MyModule\Controller\Adminhtml;

    use Magento\Backend\App\Action;
    use Magento\Backend\App\Action\Context;
    use Magento\Framework\Registry;

    /**
     * Magefan manage items controller
     */
    abstract class GreetingMessage extends Action
    {
        /**
         * Core registry
         *
         * @var Registry
         */
        protected $_coreRegistry = null;

        /**
         * @param Context $context
         * @param Registry $coreRegistry
         */
        public function __construct(
            Context $context,
            Registry $coreRegistry
        )
        {
            $this->_coreRegistry = $coreRegistry;
            parent::__construct($context);
        }

        /**
         * Init page
         *
         * @param Magento\Backend\Model\View\Result\Page $resultPage
         * @return Magento\Backend\Model\View\Result\Page
         */
        protected function initPage($resultPage)
        {
            $resultPage->setActiveMenu('Magefan_MyModule::greeting_message')
                ->addBreadcrumb(__('Greeting Message'), __('Greeting Message'))
                ->addBreadcrumb(__('Items'), __(''));
                
            return $resultPage;
        }

        /**
         * Check the permission to run it
         *
         * @return boolean
         */
        protected function _isAllowed()
        {
            return $this->_authorization->isAllowed('Magefan_MyModule::greeting_message');
        }
    }