<?php
namespace Qianrui\Customer\Plugin\Model;

class AuthenticationAgainPlugin
{
    protected $_logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ){
        $this->_logger = $logger;
    }

    /**
     * 修改参数
     *
     * @param \Magento\Customer\Model\Authentication $subject
     * @param $customerId
     * @param $password
     * @return array
     */
    public function beforeAuthenticate(\Magento\Customer\Model\Authentication $subject, $customerId, $password)
    {
        $this->_logger->info(__METHOD__, [
            $customerId,
            $password
        ]);

        return [$customerId, $password];
    }
}