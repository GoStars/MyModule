<?php
    namespace Magefan\MyModule\Controller\Adminhtml\GreetingMessage;

    use Magento\Backend\App\Action;
    use Magento\Framework\Exception\LocalizedException;

    class Save extends Action {
        /**
         * @param Action\Context $context
         */
        public function __construct(Action\Context $context) {
            parent::__construct($context);
        }

        /**
         * Save action
         *
         * @return \Magento\Framework\Controller\ResultInterface
         */
        public function execute() {
            $data = $this->getRequest()->getPostValue();
            /** 
             * @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect
             */
            $resultRedirect = $this->resultRedirectFactory->create();

            if ($data) {
                $model = $this->_objectManager->create('Magefan\MyModule\Model\GreetingMessage');
                $id = $this->getRequest()->getParam('greeting_id');

                if ($id) {
                    $model->load($id);
                }
                $model->setData($data);

                try {
                    $model->save();
                    $this->messageManager->addSuccess(__('The greeting message has been saved.'));
                    $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);

                    if ($this->getRequest()->getParam('back')) {
                        return $resultRedirect->setPath('*/*/edit', ['greeting_id' => $model->getId(), '_current' => true]);
                    }   
                    return $resultRedirect->setPath('*/*/');
                } catch (LocalizedException $e) {
                    $this->messageManager->addError($e->getMessage());
                } catch (\RuntimeException $e) {
                    $this->messageManager->addError($e->getMessage());
                } catch (\Exception $e) {
                    $this->messageManager->addException($e, __('Something went wrong while saving the greeting message.'));
                }
                $this->_getSession()->setFormData($data);
                
                return $resultRedirect->setPath('*/*/edit', ['greeting_id' => $this->getRequest()->getParam('greeting_id')]);
            }
            return $resultRedirect->setPath('*/*/');
        }
    }