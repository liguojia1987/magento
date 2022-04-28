<?php
namespace Qianrui\Helloworld\Model\Queue;

class Consumer
{
    /** @var \Psr\Log\LoggerInterface  */
    protected $logger;

    protected $json;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Serialize\Serializer\Json $json
    ){
        $this->logger = $logger;
        $this->json = $json;
    }

    public function process($message)
    {
        $this->logger->info(__METHOD__);
        $this->logger->info($message);
    }
}