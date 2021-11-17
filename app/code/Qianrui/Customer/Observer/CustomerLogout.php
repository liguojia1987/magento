<?php
namespace Qianrui\Customer\Observer;

class CustomerLogout implements \Magento\Framework\Event\ObserverInterface
{
    protected $_logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ){
        $this->_logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var \Magento\Customer\Model\Customer $customer */
        $customer = $observer->getData('customer');

        $this->_logger->info(__METHOD__, [$customer->getId()]);
    }
}