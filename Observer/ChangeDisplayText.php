<?php
    namespace Magefan\MyModule\Observer;

    use Magento\Framework\Event\ObserverInterface;
    use Magento\Framework\Event\Observer;

    class ChangeDisplayText implements ObserverInterface {
        public function execute(Observer $observer) {
            $displayText = $observer->getData('mf_text');

            echo $displayText->getText() . " - Event </br>";
            
            $displayText->setText('Execute event successfully.');

            return $this;
        }
    }