<?php
namespace Qianrui\Customer\Plugin\Model;

use Magento\Framework\App\ObjectManager;

class AuthenticationPlugin
{
    protected $_logger;

    /**
     * @var \Magento\Customer\Model\ResourceModel\CustomerRepository
     */
    protected $_customerRepository;

    protected $_customerRegistry;

    protected $_encryptor;

    /**
     * @var \Magento\Customer\Model\Session\SessionCleaner
     */
    protected $sessionCleaner;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Model\CustomerRegistry $customerRegistry,
        \Magento\Framework\Encryption\EncryptorInterface $encryptor
    ){
        $this->_logger = $logger;
        $this->_customerRepository = $customerRepository;
        $this->_customerRegistry = $customerRegistry;
        $this->_encryptor = $encryptor;

        $objectManager = ObjectManager::getInstance();
        $this->sessionCleaner = $objectManager->get(\Magento\Customer\Api\SessionCleanerInterface::class);
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
        $this->_logger->info('beforeAuthenticate', [
            $customerId,
            $password
        ]);

        // 对参数进行必要的处理
        $password = "before" . $password;

        return [$customerId, $password];
    }

    /**
     * 修改业务逻辑
     *
     * @param \Magento\Customer\Model\Authentication $subject
     * @param callable $proceed
     * @param $customerId
     * @param $password
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\State\InputMismatchException
     */
    public function aroundAuthenticate(\Magento\Customer\Model\Authentication $subject, callable $proceed, $customerId, $password)
    {
        $this->_logger->info('aroundAuthenticate', [
            $customerId,
            $password
        ]);

        // TODO: 自定义业务逻辑
        /** @var \Magento\Customer\Model\Data\Customer $customer */
        $customer = $this->_customerRepository->getById($customerId);

        $customerSecure = $this->_customerRegistry->retrieveSecureData($customerId);
        if($customerSecure->getPasswordHash()==''){
            $passwordHash = $this->_encryptor->getHash($password);

            $customerSecure->setRpToken(null);
            $customerSecure->setRpTokenCreatedAt(null);
            $customerSecure->setPasswordHash($passwordHash);
            $this->sessionCleaner->clearFor((int)$customer->getId());
            $this->_customerRepository->save($customer);
        }

        // 去掉“before”
        $password = substr($password, 6);

        // 1：调用authenticate并返回。
        return $proceed($customerId, $password);
        // 2：直接返回。不调用authenticate，可理解为替换了authenticate的实现逻辑
        //return true;
    }

    /**
     * 修改返回值
     *
     * @param \Magento\Customer\Model\Authentication $subject
     * @param $result
     * @param $customerId
     * @param $password
     * @return mixed
     */
    public function afterAuthenticate(\Magento\Customer\Model\Authentication $subject, $result, $customerId, $password)
    {
        $this->_logger->info('afterAuthenticate', [
            $result,
            $customerId,
            $password
        ]);

        // 对返回值进行必要的处理
        $result = false;

        return $result;
    }
}
