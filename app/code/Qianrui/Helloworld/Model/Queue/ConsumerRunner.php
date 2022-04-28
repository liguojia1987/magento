<?php
namespace Qianrui\Helloworld\Model\Queue;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\ShellInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Process\PhpExecutableFinder;

class ConsumerRunner
{
    const CONSUMER_NAME = 'testQueue.consumer';

    /**
     * @var ShellInterface
     */
    private $shellBackground;
    /**
     * @var PhpExecutableFinder
     */
    private $phpExecutableFinder;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * ConsumerRunner constructor.
     * @param ShellInterface $shellBackground
     * @param PhpExecutableFinder $phpExecutableFinder
     */
    public function __construct(
        ShellInterface $shellBackground,
        PhpExecutableFinder $phpExecutableFinder,
        LoggerInterface $logger
    ) {
        $this->shellBackground = $shellBackground;
        $this->phpExecutableFinder = $phpExecutableFinder;
        $this->logger = $logger;
    }

    /**
     * @param $maxMessage
     */
    public function run($maxMessage)
    {
        $php = $this->phpExecutableFinder->find() ?: 'php';

        $arguments = [
            self::CONSUMER_NAME,
            '--max-messages=' . $maxMessage
        ];
        $command = $php . ' ' . BP . '/bin/magento queue:consumers:start %s %s';

        try {
            $this->shellBackground->execute($command, $arguments);
        } catch (LocalizedException $e) {
            $this->logger->critical($e);
        }
    }
}
