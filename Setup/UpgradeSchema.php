<?php
    namespace Magefan\MyModule\Setup;

    use Magento\Framework\Setup\UpgradeSchemaInterface;
    use Magento\Framework\Setup\ModuleContextInterface;
    use Magento\Framework\Setup\SchemaSetupInterface;
    use Magento\Framework\DB\Ddl\Table;

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
            $setup->endSetup();
        }
    }
