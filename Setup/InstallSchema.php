<?php
    namespace Magefan\MyModule\Setup;

    use Magento\Framework\Setup\InstallSchemaInterface;
    use Magento\Framework\Setup\ModuleContextInterface;
    use Magento\Framework\Setup\SchemaSetupInterface;
    use Magento\Framework\DB\Ddl\Table;

    /**
     * @codeCoverageIgnore
     */
    class InstallSchema implements InstallSchemaInterface {
        /**
        * {@inheritdoc}
        * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
        */
        public function install(
            SchemaSetupInterface $setup,
            ModuleContextInterface $context
        ) {
            /**
            * Create table 'greeting_message'
            */
            $table = $setup->getConnection()
                ->newTable($setup->getTable('greeting_message'))
                    ->addColumn(
                        'greeting_id',
                        Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'unsigned' => true,
                            'nullable' => false,
                            'primary' => true
                        ],
                        'Greeting ID'
                    )
                    ->addColumn(
                        'message',
                        Table::TYPE_TEXT,
                        255,
                        [
                            'nullable' => false,
                            'default' => ''
                        ],
                        'Message'
                    )->setComment("Greeting Message table");

            $setup->getConnection()->createTable($table);
        }
    }
