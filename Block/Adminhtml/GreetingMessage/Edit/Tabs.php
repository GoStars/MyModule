<?php
    namespace Magefan\MyModule\Block\Adminhtml\GreetingMessage\Edit;

    use Magento\Backend\Block\Widget\Tabs as WidgetTabs;

    /**
     * Admin page left menu
     */
    class Tabs extends WidgetTabs {
        /**
         * @return void
         */
        protected function _construct() {
            parent::_construct();
            $this->setId('greetingmessage_tabs');
            $this->setDestElementId('edit_form');
            $this->setTitle(__('Greeting Message Information'));
        }
    }
