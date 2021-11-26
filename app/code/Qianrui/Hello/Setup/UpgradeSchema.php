<?php
namespace Qianrui\Hello\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        // $context->getVersion() 当前版本号
        // 为了执行UpgradeSchema，需要修改module.xml的setup_version，1.0.1即改后的值
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $this->getLogger()->info(111);

            $connection = $setup->getConnection();
            // 在qr_hello.name后添加status字段，默认值0
            $connection->addColumn(
                $setup->getTable('qr_hello'),
                'status',
                [
                    'type'     => Table::TYPE_SMALLINT,
                    'nullable' => false,
                    'default'  => 0,
                    'after'    => 'name',
                    'comment'  => 'Status'
                ]
            );
        }

        // 第二次UpgradeSchema，$context->getVersion()为1.0.1，前面的逻辑已经不再执行
        // 此时module.xml的setup_version的修改为1.0.2
        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $this->getLogger()->info(222);
        }

        // 同上
        if (version_compare($context->getVersion(), '1.0.3', '<')) {
            $this->getLogger()->info(333);
        }

        $setup->endSetup();
    }

    protected $logger;
    protected function getLogger()
    {
        if ($this->logger===null) {
            $this->logger = \Magento\Framework\App\ObjectManager::getInstance()
                ->get(\Psr\Log\LoggerInterface::class);
        }

        return $this->logger;
    }
}
