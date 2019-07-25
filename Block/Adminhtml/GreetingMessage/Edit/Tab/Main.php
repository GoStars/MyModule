<?php
    namespace Magefan\MyModule\Block\Adminhtml\GreetingMessage\Edit\Tab;

    use Magento\Backend\Block\Widget\Form\Generic;
    use Magento\Backend\Block\Widget\Tab\TabInterface;
    use Magento\Backend\Block\Template\Context;
    use Magento\Framework\Registry;
    use Magento\Framework\Data\FormFactory;
    use Magento\Store\Model\System\Store;

    /**
     * Greeting message edit form main tab
     */
    class Main extends Generic implements TabInterface {
        /**
         * @var \Magento\Store\Model\System\Store
         */
        protected $_systemStore;

        /**
         * @param \Magento\Backend\Block\Template\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Magento\Framework\Data\FormFactory $formFactory
         * @param \Magento\Store\Model\System\Store $systemStore
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            FormFactory $formFactory,
            Store $systemStore,
            array $data = []
        ) {
            $this->_systemStore = $systemStore;
            parent::__construct($context, $registry, $formFactory, $data);
        }

        /**
         * Prepare form
         *
         * @return $this
         *
         * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
         */
        protected function _prepareForm() {
            /**
             * @var $model \Magefan\MyModule\Model\GreetingMessage
             */
            $model = $this->_coreRegistry->registry('greetingmessage');

            $isElementDisabled = false;

            /** 
            * @var \Magento\Framework\Data\Form $form
            */
            $form = $this->_formFactory->create();

            $form->setHtmlIdPrefix('page_');

            $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Greeting Message Information')]);

            if ($model->getId()) {
                $fieldset->addField('greeting_id', 'hidden', ['name' => 'greeting_id']);
            }

            $fieldset->addField(
                'message',
                'text',
                [
                    'name' => 'message',
                    'label' => __('Message'),
                    'title' => __('Message'),
                    'required' => true,
                    'disabled' => $isElementDisabled
                ]
            );

            $fieldset->addField(
                'season',
                'text',
                [
                    'name' => 'season',
                    'label' => __('Season'),
                    'title' => __('Season'),
                    'required' => true,
                    'disabled' => $isElementDisabled
                ]
            );

            $dateFormat = $this->_localeDate->getDateFormat(
                \IntlDateFormatter::SHORT
            );

            $form->setValues($model->getData());

            $this->setForm($form);

            return parent::_prepareForm();
        }

        /**
         * Prepare label for tab
         *
         * @return \Magento\Framework\Phrase
         */
        public function getTabLabel() {
            return __('Greeting Message Information');
        }

        /**
         * Prepare title for tab
         *
         * @return \Magento\Framework\Phrase
         */
        public function getTabTitle() {
            return __('Greeting Message Information');
        }

        /**
         * {@inheritdoc}
         */
        public function canShowTab() {
            return true;
        }

        /**
         * {@inheritdoc}
         */
        public function isHidden() {
            return false;
        }

        /**
         * Check permission for passed action
         *
         * @param string $resourceId
         * @return bool
         */
        protected function _isAllowedAction($resourceId) {
            return $this->_authorization->isAllowed($resourceId);
        }
    }
