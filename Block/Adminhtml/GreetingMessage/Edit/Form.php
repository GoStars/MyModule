<?php
    namespace Magefan\MyModule\Block\Adminhtml\GreetingMessage\Edit;

    use Magento\Backend\Block\Widget\Form\Generic;
    use Magento\Cms\Model\Wysiwyg\Config;
    use Magento\Store\Model\System\Store;
    use Magento\Backend\Block\Template\Context;
    use Magento\Framework\Registry;
    use Magento\Framework\Data\FormFactory;

    /**
     * Adminhtml Magefan item edit form
     */
    class Form extends Generic
    {
        /**
         * @var Config
         */
        protected $_wysiwygConfig;

        /**
         * @var Store
         */
        protected $_systemStore;

        /**
         * @param Context $context
         * @param Registry $registry
         * @param FormFactory $formFactory
         * @param Config $wysiwygConfig
         * @param Store $systemStore
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            FormFactory $formFactory,
            Config $wysiwygConfig,
            Store $systemStore,
            array $data = []
        ) {
            $this->_wysiwygConfig = $wysiwygConfig;
            $this->_systemStore = $systemStore;
            parent::__construct($context, $registry, $formFactory, $data);
        }

        /**
         * Init form
         *
         * @return void
         */
        protected function _construct()
        {
            parent::_construct();
            $this->setId('greetingmessage_form');
            $this->setTitle(__('Item Information'));
        }

        /**
         * Prepare form
         *
         * @return $this
         */
        protected function _prepareForm()
        {
            $model = $this->_coreRegistry->registry('greetingmessage_item');

            /** @var \Magento\Framework\Data\Form $form */
            $form = $this->_formFactory->create([
                'data' => [
                    'id' => 'edit_form',
                    'action' => $this->getData('action'),
                    'method' => 'POST'
                ]
            ]);

            $form->setHtmlIdPrefix('item_');

            $fieldset = $form->addFieldset(
                'base_fieldset', 
                [
                    'legend' => __('General Information'),
                    'class' => 'fieldset-wide'
                ]
            );

            if ($model->getId()) {
                $fieldset->addField(
                    'greeting_id',
                    'hidden',
                    [
                        'name' => 'greeting_id'
                    ]
                );
            }

            $fieldset->addField(
                'message',
                'text',
                [
                    'name' => 'message',
                    'label' => __('Message'),
                    'title' => __('Message'),
                    'required' => true
                ]
            );

            $fieldset->addField(
                'season',
                'text',
                [
                    'name' => 'season',
                    'label' => __('Season'),
                    'title' => __('Season'),
                    'required' => true
                ]
            );

            $fieldset->addField(
                'is_active',
                'select',
                [
                    'name' => 'is_active',
                    'label' => __('Status'),
                    'title' => __('Status'),
                    'required' => true,
                    'options' => [
                        '1' => __('Enabled'),
                        '0' => __('Disabled')
                    ]
                ]
            );

            if (!$model->getId()) {
                $model->setData('is_active', '1');
            }

            $form->setValues($model->getData());
            $form->setUseContainer(true);
            $this->setForm($form);

            return parent::_prepareForm();
        }
    }