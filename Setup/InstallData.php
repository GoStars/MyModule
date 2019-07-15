<?php
    namespace Magefan\MyModule\Setup;

    use Magento\Framework\Setup\InstallDataInterface;
    use Magento\Framework\Setup\ModuleContextInterface;
    use Magento\Framework\Setup\ModuleDataSetupInterface;

    /**
     * @codeCoverageIgnore
     */
    class InstallData implements InstallDataInterface {

        /**
         * {@inheritdoc}
         * @SuppressWarnings(PHPMD.CyclomaticComplexity)
         * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
         * @SuppressWarnings(PHPMD.NPathComplexity)
         */
        public function install(
            ModuleDataSetupInterface $setup,
            ModuleContextInterface $context
        ) {
            /**
            * Install messages
            */
            $data = [
              ['message' => 'Happy New Year'],
              ['message' => 'Merry Christmas']
            ];

            foreach ($data as $bind) {
                $setup->getConnection()
                    ->insertForce($setup->getTable('magefan_mymodule_greeting_message'), $bind);
            }
        }
    }
