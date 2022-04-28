<?php
namespace Qianrui\Helloworld\Cron;

class Publish
{
    const TOPIC_NAME = 'testQueue.topic';

    /* @var \Magento\Framework\MessageQueue\PublisherPool  */
    protected $publisher;

    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    protected $json;

    /** @var \Psr\Log\LoggerInterface  */
    protected $logger;

    protected $consumerRunner;

    public function __construct(
        \Magento\Framework\MessageQueue\PublisherInterface $publisher,
        \Magento\Framework\Serialize\Serializer\Json $json,
        \Psr\Log\LoggerInterface $logger,
        \Qianrui\Helloworld\Model\Queue\ConsumerRunner $consumerRunner
    ){
        $this->logger = $logger;
        $this->publisher = $publisher;
        $this->json = $json;
        $this->consumerRunner = $consumerRunner;
    }

    public function execute()
    {
        $this->logger->info(__METHOD__);

        $this->publisher->publish(self::TOPIC_NAME, date('Y-m-d H:i:s'));

        $this->consumerRunner->run(1);

//        $rawData = [
//            'id' => 1,
//            'name' => 'jacky'
//        ];
//        //echo $this->json->serialize($rawData);exit;
//        $this->publisher->publish(self::TOPIC_NAME, $this->json->serialize($rawData));
    }
}