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
            $this->_controller = 'adminhtml';
            $this->_blockGroup = 'Magefan_MyModule';
            $this->_headerText = __('Manage Greeting Message');
            $this->_addButtonLabel = __('Add New Message');
            parent::_construct();
        }
    }