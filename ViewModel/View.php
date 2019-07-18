<?php
    namespace Magefan\MyModule\ViewModel;

    use Magento\Framework\View\Element\Block\ArgumentInterface;
    use Magefan\MyModule\Model\GreetingMessageFactory;
    use Magefan\MyModule\Helper\Data;

    class View implements ArgumentInterface {
        protected $_greetingMessageFactory;

        protected $helperData;

        public function __construct(
            GreetingMessageFactory $greetingMessageFactory,
            Data $helperData
        ) {
            $this->_greetingMessageFactory = $greetingMessageFactory;
            $this->helperData = $helperData;
        }

        public function sayHello() {
            return __('Hello World!');
        }

        public function displayText() {
            $enable = $this->helperData->getGeneralConfig('enable');
            $text = $this->helperData->getGeneralConfig('display_text');

            if ($enable == 1) {
                return $text;
            } else {
                return 'Module disabled!';
            }
        }

        public function getGreetingMessageCollection() {
            $greetingMessage = $this->_greetingMessageFactory->create();
            return $greetingMessage->getCollection();
        }
    }
