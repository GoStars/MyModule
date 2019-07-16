<?php
    namespace Magefan\MyModule\Controller\Page;

    use Magento\Framework\App\Action\Action;
    use Magento\Framework\App\Action\Context;
    use Magefan\MyModule\Helper\Data;

    class Config extends Action {
        protected $helperData;

        public function __construct(
            Context $context,
            Data $helperData
        ) {
            $this->helperData = $helperData;
            return parent::__construct($context);
        }

        public function execute() {
            // TODO: Implement execute() method.

            $enable = $this->helperData->getGeneralConfig('enable');
            $displayText = $this->helperData->getGeneralConfig('display_text');

            if ($enable == 1) {
                echo $displayText;
            } else {
                echo 'Module disabled!';
            }

            exit();
        }
    }
