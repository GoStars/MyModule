<?php
    namespace Magefan\MyModule\Block\Adminhtml;

    use Magento\Backend\Block\Widget\Grid\Container;

    class GreetingMessage extends Container {
        /**
         * Constructor
         *
         * @return void
         */
        protected function _construct() {
            $this->_blockGroup = 'Magefan_MyModule';
            $this->_controller = 'adminhtml_greetingMessage';
            $this->_headerText = __('Items');
            $this->_addButtonLabel = __('Add New Item');
            parent::_construct();
        }
    }