<?php
    namespace Magefan\MyModule\Controller\Adminhtml\GreetingMessage;

    use Magefan\MyModule\Controller\Adminhtml\GreetingMessage;
    use Magento\Framework\View\Result\PageFactory;
    use Magento\Backend\App\Action\Context;
    use Magento\Framework\Registry;

    class Edit extends GreetingMessage
    {
        /**
         * @var PageFactory
         */
        protected $resultPageFactory;

        /**
         * @param Context $context
         * @param Registry $coreRegistry
         * @param PageFactory $resultPageFactory
         */
        public function __construct(
            Context $context,
            Registry $coreRegistry,
            PageFactory $resultPageFactory
        ) {
            $this->resultPageFactory = $resultPageFactory;
            parent::__construct($context, $coreRegistry);
        }

        /**
         * Edit item
         *
         * @return \Magento\Framework\Controller\ResultInterface
         *
         * @SuppressWarnings(PHPMD.NPathComplexity)
         */
        public function execute()
        {
            // 1. Get ID and create model
            $id = $this->getRequest()->getParam('greeting_id');
            $model = $this->_objectManager->create('Magefan\MyModule\Model\GreetingMessage');

            // 2. Initial checking
            if ($id) {
                $model->load($id);
                if (!$model->getId()) {
                    $this->messageManager->addError(__('This item no longer exists.'));
                    /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
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
            $this->_coreRegistry->register('greetingmessage_item', $model);

            /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
            $resultPage = $this->resultPageFactory->create();

            // 5. Build edit form
            $this->initPage($resultPage)->addBreadcrumb(
                $id ? __('Edit Item') : __('New Item'),
                $id ? __('Edit Item') : __('New Item')
            );
            $resultPage->getConfig()->getTitle()->prepend(__('Items'));
            $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getName() : __('New Item'));
            
            return $resultPage;
        }
    }