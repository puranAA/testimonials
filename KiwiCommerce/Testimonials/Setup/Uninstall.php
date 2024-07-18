<?php
namespace KiwiCommerce\Testimonials\Setup;

use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class Uninstall implements UninstallInterface
{
    /**
     * Remove data that was created during module installation.
     *
     * @param SchemaSetupInterface   $installer
     * @param ModuleContextInterface $context
     *
     * @return void
     */
    public function uninstall(SchemaSetupInterface $installer, ModuleContextInterface $context): void
    {
        $installer->startSetup();

        $installer->getConnection()->dropTable($installer->getTable('kiwi_commerce_testimonials'));
        $installer->endSetup();
    }

}