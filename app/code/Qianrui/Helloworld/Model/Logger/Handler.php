<?php
namespace Qianrui\Helloworld\Model\Logger;

use Magento\Framework\Filesystem\DriverInterface;
use Monolog\Logger;

class Handler extends \Magento\Framework\Logger\Handler\Base
{
    protected $_filename = 'helloworld.log';
    protected $loggerType = Logger::INFO;

    public function __construct(DriverInterface $filesystem, string $filePath = null, string $fileName = null)
    {
        // 日志文件路径
//        $_date = \Magento\Framework\App\ObjectManager::getInstance()->create(\Magento\Framework\Stdlib\DateTime\TimezoneInterface::class);
//        $ymd = $_date->date()->format('Ymd');
//        $fileName = 'var/log/' . $ymd . '/' . $this->_filename;
        $fileName = 'var/log/' . $this->_filename;

        parent::__construct($filesystem, $filePath, $fileName);
    }
}