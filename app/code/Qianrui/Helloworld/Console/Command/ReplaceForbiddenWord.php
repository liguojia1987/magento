<?php
namespace Qianrui\Helloworld\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ReplaceForbiddenWord extends Command{

    const INPUT_STORE_ID = 'storeId';

    protected $_resourceConnection;

    /**
     * ReplaceForbiddenWord constructor.
     * @param \Magento\Framework\App\ResourceConnection $resourceConnection
     */
    public function __construct(
        \Magento\Framework\App\ResourceConnection $resourceConnection
    ) {
        $this->_resourceConnection = $resourceConnection;

        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('qianrui:helloworld:replace-forbidden-word')
            ->setDescription('Replace forbidden word')
            ->addOption(
                self::INPUT_STORE_ID,
                null,
                InputOption::VALUE_OPTIONAL,
                'Specific store id',
                null
            );
    }

    /**
     * Regenerate Url Rewrites
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        set_time_limit(0);
        $output->writeln('Replacing forbidden word...');

        $storeIds = [];
        // 获取可选项storeId
        $storeId = $input->getOption(self::INPUT_STORE_ID);
        if(is_null($storeId)){
            $storeIds = $this->getAllStoreIds();
        }else{
            $storeIds[] = $storeId;
        }

        // TODO:具体业务逻辑

        # 调用shell命令，windows系统无效
        #shell_exec('php bin/magento indexer:reindex');
        #shell_exec('php bin/magento cache:clean');
        #shell_exec('php bin/magento cache:flush');

        $output->writeln('Finished...');
    }

    public function getAllStoreIds() {
        $result = [];

        $connection = $this->_resourceConnection->getConnection();
        $sql = $connection->select()
            ->from($this->_resourceConnection->getTableName('store'), array('store_id'))
            ->order('store_id', 'ASC');

        $queryResult = $connection->fetchAll($sql);

        foreach ($queryResult as $row) {
            $result[] = (int)$row['store_id'];
        }

        return $result;
    }
}