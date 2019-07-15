<?php
    namespace Magefan\MyModule\Model;

    use Magento\Framework\Model\AbstractModel;
    use Magento\Framework\DataObject\IdentityInterface;

    class GreetingMessage extends AbstractModel implements IdentityInterface {
        const CACHE_TAG = 'magefan_mymodule_greeting_message';
        protected $_cacheTag = 'magefan_mymodule_greeting_message';
        protected $_eventPrefix = 'magefan_mymodule_greeting_message';

        protected function _construct() {
            $this->_init('Magefan\MyModule\Model\ResourceModel\GreetingMessage');
        }

        public function getIdentities() {
            return [self::CACHE_TAG . '_' . $this->getId()];
        }

        public function getDefaultValues() {
            $values = [];

            return $values;
        }
    }
