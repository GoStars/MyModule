<?php
    namespace Magefan\MyModule\Controller\Adminhtml\GreetingMessage;

    use Magento\Backend\App\Action;
    use Magento\Framework\View\Result\PageFactory;
    use Magento\Framework\Registry;

    class Edit extends Action {
        /**
         * Core registry
         *
         * @var \Magento\Framework\Registry
         */
        protected $_coreRegistry = null;

        /**
         * @var \Magento\Framework\View\Result\PageFactory
         */
        protected $resultPageFactory;

        /**
         * @param Action\Context $context
         * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
         * @param \Magento\Framework\Registry $registry
         */
        public function __construct(
            Action\Context $context,
            PageFactory $resultPageFactory,
            Registry $registry
        ) {
            $this->resultPageFactory = $resultPageFactory;
            $this->_coreRegistry = $registry;
            parent::__construct($context);
        }

        /**
         * {@inheritdoc}
         */
        protected function _isAllowed() {
            return true;
        }

        /**
         * Init actions
         *
         * @return \Magento\Backend\Model\View\Result\Page
         */
        protected function _initAction() {
            /**
             * load layout, set active menu and breadcrumbs
             *
             * @var \Magento\Backend\Model\View\Result\Page $resultPage 
             */
            $resultPage = $this->resultPageFactory->create();
            $resultPage->setActiveMenu('Magefan_MyModule::greetingmessage')
                ->addBreadcrumb(__('Greeting Message'), __('Greeting Message'))
                ->addBreadcrumb(__('Manage Greeting Message'), __('Manage Greeting Message'));

            return $resultPage;
        }

        /**
         * Edit Greeting Message
         *
         * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
         *
         * @SuppressWarnings(PHPMD.NPathComplexity)
         */
        public function execute() {
            // 1. Get ID and create model
            $id = $this->getRequest()->getParam('greeting_id');
            $model = $this->_objectManager->create('Magefan\MyModule\Model\GreetingMessage');

            // 2. Initial checking
            if ($id) {
                $model->load($id);

                if (!$model->getId()) {
                    $this->messageManager->addError(__('This greeting message no longer exists.'));
                    /** 
                     * @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect 
                     */
                    $resultRedirect = $this->resultRedirectFactory->create();

                    return $resultRedirect->setPath('*/*/');
                }
            }

            // 3. Set entered data if was error when we do save
            $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);

            if (!empty($data)) {
                $model->setData($data);
            }

            // 4. Register model to use later in blocks
            $this->_coreRegistry->register('greetingmessage', $model);

            // 5. Build edit form
            /** 
             * @var \Magento\Backend\Model\View\Result\Page $resultPage
             */
            $resultPage = $this->_initAction();
            $resultPage->addBreadcrumb(
                $id ? __('Edit Greeting Message') : __('New Greeting Message'),
                $id ? __('Edit Greeting Message') : __('New Greeting Message')
            );
            $resultPage->getConfig()->getTitle()->prepend(__('Greeting Messages'));
            $resultPage->getConfig()->getTitle()
                ->prepend($model->getId() ? $model->getMessage() : __('New Greeting Message'));
                
            return $resultPage;
        }
    }