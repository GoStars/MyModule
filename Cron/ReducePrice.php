<?php
    namespace Magefan\MyModule\Cron;

    use Zend\Log\Writer\Stream;
    use Zend\Log\Logger;
    use Magento\Catalog\Model\ProductFactory;

    class ReducePrice {
        protected $_productFactory;

        public function __construct(ProductFactory $productFactory) {
            $this->_productFactory = $productFactory;
        }

        public function getPriceById($id) {
            $product = $this->_productFactory->create();
            $productPriceById = $product->load($id)->getPrice();
            
            return $productPriceById;
        }

        public function execute() {
            $product = $this->_productFactory->create()->load(1);
            $price = $this->getPriceById(1);

            if ($price > 5) {
                $price -= 1;
            }

            $product->setPrice($price);
            $product->save();

            $writer = new Stream(BP . '/var/log/cron.log');
            $logger = new Logger();
            
            $logger->addWriter($writer);
            $logger->info('Price changed!');

            return $this;
        }
    }
