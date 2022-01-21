<?php
// nginx 置于pub目录
require __DIR__ . '/../app/bootstrap.php';
// apache 置于根目录
//require __DIR__ . '/app/bootstrap.php';

if (php_sapi_name() !== 'cli' && isset($_GET['job'])) {
    define('CRONJOBCLASS', $_GET['job']);
} elseif (php_sapi_name() !== 'cli') {
    die('Please add the class of the cron job you want to execute as a job parameter (?job=Vendor\Module\Class)');
} elseif (!isset($argv[1])) {
    die('Please add the class of the cron job you want to execute enclosed IN DOUBLE QUOTES as a parameter.' . PHP_EOL);
} else {
    define('CRONJOBCLASS', $argv[1]);
}

// 支持多方法。默认execute
$method = (isset($_GET['method']))? $_GET['method'] : 'execute';
define('CRONJOBMETHOD', $method);

/**
 * 访问链接1 http://local.magento.com/cronLaunch.php?job=Vendor\Module\Cron\Class
 * 访问链接2 http://local.magento.com/cronLaunch.php?job=Vendor\Module\Cron\Class&method=METHOD
 *
 * Class CronRunner
 */
class CronRunner extends \Magento\Framework\App\Http
    implements \Magento\Framework\AppInterface
{

    public function __construct(
        \Magento\Framework\App\State $state,
        \Magento\Framework\App\Response\Http $response)
    {
        $this->_response = $response;
        $state->setAreaCode('crontab');
    }

    function launch()
    {
        $cron = \Magento\Framework\App\ObjectManager::getInstance()
            ->create(CRONJOBCLASS);

        // 支持多方法
        // $cron->execute();
        $cron->{CRONJOBMETHOD}();

        return $this->_response;
    }
}

$bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $_SERVER);
$app = $bootstrap->createApplication(CronRunner::class);
$bootstrap->run($app);