<?php
    namespace Magefan\MyModule\Setup;

    use Magento\Framework\Setup\UpgradeDataInterface;
    use Magento\Framework\Setup\ModuleContextInterface;
    use Magento\Framework\Setup\ModuleDataSetupInterface;
    use Magento\Eav\Setup\EavSetupFactory;
    use Magento\Catalog\Model\Product;
    use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

    /**
     * Upgrade Data script
     */
    class UpgradeData implements UpgradeDataInterface {
        /**
         * Eav setup factory
         * @var EavSetupFactory
         */
        private $eavSetupFactory;

        /**
         * Init
         * @param EavSetupFactory $eavSetupFactory
         */
        public function __construct(EavSetupFactory $eavSetupFactory) {
            $this->eavSetupFactory = $eavSetupFactory;
        }

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
                $table = $setup->getTable('magefan_mymodule_greeting_message');

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

            if ($context->getVersion()
                && version_compare($context->getVersion(), '1.0.3') < 0
            ) {
                $eavSetup = $this->eavSetupFactory->create();
                $eavSetup->addAttribute(
                    Product::ENTITY,
                    'clothing_material',
                    [
                        'group' => 'General',
                        'type' => 'varchar',
                        'label' => 'Clothing Material',
                        'input' => 'select',
                        'source' => 'Magefan\MyModule\Model\Attribute\Source\Material',
                        'frontend' => 'Magefan\MyModule\Model\Attribute\Frontend\Material',
                        'backend' => 'Magefan\MyModule\Model\Attribute\Backend\Material',
                        'required' => false,
                        'sort_order' => 50,
                        'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                        'is_used_in_grid' => false,
                        'is_visible_in_grid' => false,
                        'is_filterable_in_grid' => false,
                        'visible' => true,
                        'is_html_allowed_on_front' => true,
                        'visible_on_front' => true
                    ]
                );
            }
            
            $setup->endSetup();
        }
    }
