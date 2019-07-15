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
            echo $this->helperData->getGeneralConfig('enable');
            echo $this->helperData->getGeneralConfig('display_text');
            exit();
        }
    }
