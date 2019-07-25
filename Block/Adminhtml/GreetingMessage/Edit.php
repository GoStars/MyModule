<?php
    namespace Magefan\MyModule\Block\Adminhtml\GreetingMessage;

    use Magento\Backend\Block\Widget\Form\Container;
    use Magento\Backend\Block\Widget\Context;
    use Magento\Framework\Registry;

    class Edit extends Container {
        /**
         * Core registry
         *
         * @var \Magento\Framework\Registry
         */
        protected $_coreRegistry = null;

        /**
         * @param \Magento\Backend\Block\Widget\Context $context
         * @param \Magento\Framework\Registry $registry
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
         * Initialize greeting message edit block
         *
         * @return void
         */
        protected function _construct() {
            $this->_objectId = 'greeting_id';
            $this->_blockGroup = 'Magefan_MyModule';
            $this->_controller = 'adminhtml_greetingmessage';

            parent::_construct();

            $this->buttonList->update('save', 'label', __('Save Greeting Message'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );

            $this->buttonList->update('delete', 'label', __('Delete'));
        }

        /**
         * Retrieve text for header element depending on loaded greeting message
         *
         * @return \Magento\Framework\Phrase
         */
        public function getHeaderText() {
            if ($this->_coreRegistry->registry('greetingmessage')->getId()) {
                return __("Edit Greeting Message '%1'", $this->escapeHtml($this->_coreRegistry->registry('greetingmessage')->getMessage()));
            } else {
                return __('New Greeting Message');
            }
        }

        /**
         * Getter of url for "Save and Continue" button
         * tab_id will be replaced by desired by JS later
         *
         * @return string
         */
        protected function _getSaveAndContinueUrl() {
            return $this->getUrl('magefan_mymodule/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '{{tab_id}}']);
        }

        /**
         * Prepare layout
         *
         * @return \Magento\Framework\View\Element\AbstractBlock
         */
        protected function _prepareLayout() {
            $this->_formScripts[] = "
                function toggleEditor() {
                    if (tinyMCE.getInstanceById('page_content') == null) {
                        tinyMCE.execCommand('mceAddControl', false, 'content');
                    } else {
                        tinyMCE.execCommand('mceRemoveControl', false, 'content');
                    }
                };
            ";
            return parent::_prepareLayout();
        }
    }
