<?php
namespace Qianrui\Hello\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $adapter = $setup->getConnection();
        $setup->startSetup();

        $adapter->insertMultiple('qr_hello', ['name'=>'aaa']);
        $adapter->insertMultiple('qr_hello', [['name'=>'bbb'], ['name'=>'ccc']]);

        $setup->endSetup();
    }
}
