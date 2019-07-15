<?php
    namespace Magefan\MyModule\Block;

    use Magento\Framework\View\Element\Template;
    use Magento\Framework\View\Element\Template\Context;
    use Magefan\MyModule\Model\GreetingMessageFactory;

    class View extends Template {
        protected $_greetingMessageFactory;

        public function __construct(
            Context $context,
            GreetingMessageFactory $greetingMessageFactory
        ) {
            $this->_greetingMessageFactory = $greetingMessageFactory;
            parent::__construct($context);
        }

        public function sayHello() {
            return __('Hello World!');
        }

        public function getGreetingMessageCollection() {
            $greetingMessage = $this->_greetingMessageFactory->create();
            return $greetingMessage->getCollection();
        }
    }
