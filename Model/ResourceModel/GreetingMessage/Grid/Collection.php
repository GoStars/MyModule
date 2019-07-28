<?php
    namespace Magefan\MyModule\Model\ResourceModel\GreetingMessage\Grid;

    use Magento\Framework\Api\Search\SearchResultInterface;
    use Magento\Framework\Search\AggregationInterface;
    use Magefan\MyModule\Model\ResourceModel\GreetingMessage\Collection as GreetingMessageCollection;
    use Magento\Framework\Data\Collection\EntityFactoryInterface;
    use Psr\Log\LoggerInterface;
    use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
    use Magento\Framework\Event\ManagerInterface;
    use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
    use Magento\Framework\Api\SearchCriteriaInterface;
    use Magento\Framework\DB\Adapter\AdapterInterface;

    /**
     * Collection for displaying grid of Magefan Items
     */
    class Collection extends GreetingMessageCollection implements SearchResultInterface
    {
        /**
         * @var AggregationInterface
         */
        protected $aggregations;

        /**
         * @param EntityFactoryInterface $entityFactory
         * @param LoggerInterface $logger
         * @param FetchStrategyInterface $fetchStrategy
         * @param ManagerInterface $eventManager
         * @param string $mainTable
         * @param string $eventPrefix
         * @param string $eventObject
         * @param string $resourceModel
         * @param string $model
         * @param AdapterInterface $connection
         * @param AbstractDb $resource
         *
         * @SuppressWarnings(PHPMD.ExcessiveParameterList)
         */
        public function __construct(
            EntityFactoryInterface $entityFactory,
            LoggerInterface $logger,
            FetchStrategyInterface $fetchStrategy,
            ManagerInterface $eventManager,
            $mainTable,
            $eventPrefix,
            $eventObject,
            $resourceModel,
            $model = 'Magento\Framework\View\Element\UiComponent\DataProvider\Document',
            AdapterInterface $connection = null,
            AbstractDb $resource = null
        ) {
            parent::__construct(
                $entityFactory,
                $logger,
                $fetchStrategy,
                $eventManager,
                $connection,
                $resource
            );
            $this->_eventPrefix = $eventPrefix;
            $this->_eventObject = $eventObject;
            $this->_init($model, $resourceModel);
            $this->setMainTable($mainTable);
        }

        /**
         * @return AggregationInterface
         */
        public function getAggregations()
        {
            return $this->aggregations;
        }

        /**
         * @param AggregationInterface $aggregations
         * @return $this
         */
        public function setAggregations($aggregations)
        {
            $this->aggregations = $aggregations;
        }


        /**
         * Retrieve all ids for collection
         * Backward compatibility with EAV collection
         *
         * @param int $limit
         * @param int $offset
         * @return array
         */
        public function getAllIds($limit = null, $offset = null)
        {
            return $this->getConnection()->fetchCol($this->_getAllIdsSelect($limit, $offset), $this->_bindParams);
        }

        /**
         * Get search criteria
         *
         * @return SearchCriteriaInterface|null
         */
        public function getSearchCriteria()
        {
            return null;
        }

        /**
         * Set search criteria
         *
         * @param SearchCriteriaInterface $searchCriteria
         * @return $this
         *
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null)
        {
            return $this;
        }

        /**
         * Get total count
         *
         * @return int
         */
        public function getTotalCount()
        {
            return $this->getSize();
        }

        /**
         * Set total count
         *
         * @param int $totalCount
         * @return $this
         *
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        public function setTotalCount($totalCount)
        {
            return $this;
        }

        /**
         * Set items list
         *
         * @param \Magento\Framework\Api\ExtensibleDataInterface[] $items
         * @return $this
         *
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        public function setItems(array $items = null)
        {
            return $this;
        }
    }