<?php
    namespace Magefan\MyModule\Controller\Adminhtml\GreetingMessage;

    use Magefan\MyModule\Controller\Adminhtml\GreetingMessage;

    class Save extends GreetingMessage
    {
        /**
         * Save action
         *
         * @return \Magento\Framework\Controller\ResultInterface
         */
        public function execute()
        {
            /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();
            // check if data sent
            $data = $this->getRequest()->getPostValue();

            if ($data) {
                $id = $this->getRequest()->getParam('greeting_id');
                $model = $this->_objectManager->create('Magefan\MyModule\Model\GreetingMessage')->load($id);

                if (!$model->getId() && $id) {
                    $this->messageManager->addError(__('This item no longer exists.'));

                    return $resultRedirect->setPath('*/*/');
                }

                // init model and set data
                $model->setData($data);

                // try to save it
                try {
                    // save the data
                    $model->save();
                    // display success message
                    $this->messageManager->addSuccess(__('You saved the item.'));
                    // clear previously saved data from session
                    $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);

                    // check if 'Save and Continue'
                    if ($this->getRequest()->getParam('back')) {
                        return $resultRedirect->setPath('*/*/edit', [
                            'greeting_id' => $model->getId()
                        ]);
                    }

                    // go to grid
                    return $resultRedirect->setPath('*/*/');
                } catch (\Exception $e) {
                    // display error message
                    $this->messageManager->addError($e->getMessage());
                    // save data in session
                    $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData($data);

                    // redirect to edit form
                    return $resultRedirect->setPath('*/*/edit', [
                        'greeting_id' => $this->getRequest()->getParam('greeting_id')
                    ]);
                }
            }
            
            return $resultRedirect->setPath('*/*/');
        }
    }