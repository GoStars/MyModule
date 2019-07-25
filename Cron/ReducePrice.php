<?php
    namespace Magefan\MyModule\Cron;

    use Zend\Log\Writer\Stream;
    use Zend\Log\Logger;
    use Magento\Catalog\Model\ProductRepository;

    class ReducePrice {
        protected $_productRepository;

        public function __construct(ProductRepository $productRepository) {
            $this->_productRepository = $productRepository;
        }

        public function reduceProductPrice($id) {
            $product = $this->_productRepository->getById($id);
            $price = $product->getPrice();

            if ($price > 5) {
                $price -= 1;

                $product->setPrice($price);
                $product->save();

                return 'Price changed to ' . $price . '!';
            } else {
                return 'Price didn\'t change!';
            }
        }

        public function execute() {
            $result = $this->reduceProductPrice(1);

            $writer = new Stream(BP . '/var/log/cron.log');
            $logger = new Logger();
            
            $logger->addWriter($writer);
            $logger->info($result);

            return $this;
        }
    }
