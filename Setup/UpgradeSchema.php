<?php
    namespace Magefan\MyModule\Setup;

    use Magento\Framework\Setup\UpgradeSchemaInterface;
    use Magento\Framework\Setup\ModuleContextInterface;
    use Magento\Framework\Setup\SchemaSetupInterface;
    use Magento\Framework\DB\Ddl\Table;
    use Magento\Framework\DB\Adapter\AdapterInterface;

    /**
     * Upgrade the Catalog module DB scheme
     */
    class UpgradeSchema implements UpgradeSchemaInterface {
        /**
         * {@inheritdoc}
         */
        public function upgrade(
            SchemaSetupInterface $setup,
            ModuleContextInterface $context
        ) {
            $setup->startSetup();

            if (version_compare($context->getVersion(), '1.0.1', '<')) {
                $setup->getConnection()->addColumn(
                    $setup->getTable('magefan_mymodule_greeting_message'),
                    'season',
                    [
                        'type' => Table::TYPE_TEXT,
                        'length' => 16,
                        'nullable' => false,
                        'default' => '',
                        'comment' => 'Season'
                    ]
                );
            }

            if (version_compare($context->getVersion(), '1.0.2', '<')) {
                $setup->getConnection()->addColumn(
                    $setup->getTable('magefan_mymodule_greeting_message'),
                    'created_at',
                    [
                        'type' => Table::TYPE_TIMESTAMP,
                        'length' => null,
                        'nullable' => false,
                        'default' => Table::TIMESTAMP_INIT,
                        'comment' => 'Created At'
                    ]
                );
                
                $setup->getConnection()->addColumn(
                    $setup->getTable('magefan_mymodule_greeting_message'),
                    'updated_at',
                    [
                        'type' => Table::TYPE_TIMESTAMP,
                        'length' => null,
                        'nullable' => false,
                        'default' => Table::TIMESTAMP_INIT_UPDATE,
                        'comment' => 'Updated At'
                    ]
                );
            }

            if (version_compare($context->getVersion(), '1.0.4', '<')) {
                $setup->getConnection()->addColumn(
                    $setup->getTable('magefan_mymodule_greeting_message'),
                    'is_active',
                    [
                        'type' => Table::TYPE_SMALLINT,
                        'length' => null,
                        'nullable' => false,
                        'default' => '1',
                        'comment' => 'Is Active'
                    ]
                );

                $setup->getConnection()->addIndex(
                    $setup->getTable('magefan_mymodule_greeting_message'),
                    $setup->getConnection()->getIndexName(
                        $setup->getTable('magefan_mymodule_greeting_message'),
                        ['message', 'season'],
                        AdapterInterface::INDEX_TYPE_FULLTEXT
                    ),
                    ['message', 'season'],
                    AdapterInterface::INDEX_TYPE_FULLTEXT
                );
            }

            $setup->endSetup();
        }
    }
