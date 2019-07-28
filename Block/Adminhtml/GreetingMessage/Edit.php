<?php
    namespace Magefan\MyModule\Block\Adminhtml\GreetingMessage;

    use Magento\Backend\Block\Widget\Form\Container;
    use Magento\Backend\Block\Widget\Context;
    use Magento\Framework\Registry;

    /**
     * Magefan item edit form container
     */
    class Edit extends Container
    {
        /**
         * Core registry
         *
         * @var Registry
         */
        protected $_coreRegistry = null;

        /**
         * @param Context $context
         * @param Registry $registry
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            array $data = []
        ) {
            $this->_coreRegistry = $registry;
            parent::__construct($context, $data);
        }

        /**
         * @return void
         */
        protected function _construct()
        {
            $this->_objectId = 'greeting_id';
            $this->_blockGroup = 'Magefan_MyModule';
            $this->_controller = 'adminhtml_greetingMessage';

            parent::_construct();

            $this->buttonList->update('save', 'label', __('Save Item'));
            $this->buttonList->update('delete', 'label', __('Delete Item'));

            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => [
                                'event' => 'saveAndContinueEdit',
                                'target' => '#edit_form'
                            ]
                        ]
                    ]
                ],
                -100
            );
        }

        /**
         * Get edit form container header text
         *
         * @return \Magento\Framework\Phrase
         */
        public function getHeaderText()
        {
            if ($this->_coreRegistry->registry('greetingmessage_item')->getId()) {
                return __("Edit Block '%1'", $this->escapeHtml($this->_coreRegistry->registry('greetingmessage_item')->getName()));
            } else {
                return __('New Item');
            }
        }
    }