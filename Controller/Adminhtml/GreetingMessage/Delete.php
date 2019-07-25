<?php
    namespace Magefan\MyModule\Controller\Adminhtml\GreetingMessage;

    use Magento\Backend\App\Action;

    class Delete extends Action {
        /**
         * Delete action
         *
         * @return \Magento\Backend\Model\View\Result\Redirect
         */
        public function execute() {
            // check if we know what should be deleted
            $id = $this->getRequest()->getParam('greeting_id');
            /** 
             * @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect
             */
            $resultRedirect = $this->resultRedirectFactory->create();

            if ($id) {
                $message = "";

                try {
                    // init model and delete
                    $model = $this->_objectManager->create('Magefan\MyModule\Model\GreetingMessage');
                    $model->load($id);
                    $message = $model->getMessage();
                    $model->delete();
                    // display success message
                    $this->messageManager->addSuccess(__('The greeting message has been deleted.'));
                    
                    return $resultRedirect->setPath('*/*/');
                } catch (\Exception $e) {
                    // display error message
                    $this->messageManager->addError($e->getMessage());
                    // go back to edit form
                    return $resultRedirect->setPath('*/*/edit', ['greeting_id' => $id]);
                }
            }
            // display error message
            $this->messageManager->addError(__('We can\'t find a greeting message to delete.'));
            // go to grid
            return $resultRedirect->setPath('*/*/');
        }
    }