<?php
    namespace Magefan\MyModule\Setup;

    use Magento\Framework\Setup\UpgradeDataInterface;
    use Magento\Framework\Setup\ModuleContextInterface;
    use Magento\Framework\Setup\ModuleDataSetupInterface;

    /**
     * Upgrade Data script
     */
    class UpgradeData implements UpgradeDataInterface {
        /**
         * {@inheritdoc}
         * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
         */
        public function upgrade(
            ModuleDataSetupInterface $setup,
            ModuleContextInterface $context
        ) {
            $setup->startSetup();

            if ($context->getVersion()
                && version_compare($context->getVersion(), '1.0.1') < 0
            ) {
                $table = $setup->getTable('greeting_message');

                $setup->getConnection()->insertForce($table, [
                    'message' => 'Happy Thanksgiving',
                    'season' => 'fall'
                ]);

                $setup->getConnection()->update(
                    $table,
                    ['season' => 'winter'],
                    'greeting_id IN (1,2)'
                );
            }
            $setup->endSetup();
        }
    }
