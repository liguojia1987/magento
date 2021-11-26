<?php
namespace Qianrui\Hello\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $setup->getConnection()->insertMultiple('qr_hello', [
                ['name'=>'ddd', 'status'=>1],
                ['name'=>'eee', 'status'=>0]
            ]);
        }

        $setup->endSetup();
    }
}
