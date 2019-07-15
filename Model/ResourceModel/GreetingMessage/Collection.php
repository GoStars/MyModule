<?php
    namespace Magefan\MyModule\Model\ResourceModel\GreetingMessage;

    use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

    class Collection extends AbstractCollection {
        protected $_idFieldName = 'greeting_id';
        protected $_eventPrefix = 'magefan_mymodule_greeting_message_collection';
        protected $_eventObject = 'greeting_message_collection';

        /**
         * Define resource model
         *
         * @return void
         */
        protected function _construct() {
            $this->_init('Magefan\MyModule\Model\GreetingMessage', 'Magefan\MyModule\Model\ResourceModel\GreetingMessage');
        }

    }
