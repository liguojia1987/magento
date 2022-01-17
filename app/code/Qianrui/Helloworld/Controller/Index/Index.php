<?php
namespace Qianrui\Helloworld\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    /**
     * @var \Qianrui\Helloworld\Model\Logger
     */
    protected $_logger;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Qianrui\Helloworld\Model\Logger\Logger $logger
    ){
        $this->_pageFactory = $pageFactory;
        $this->_logger = $logger;

        return parent::__construct($context);
    }

    public function execute()
    {
        //echo "Hello World";exit;

        $this->_logger->info("Helloworld");

        // 使用layout生成页面
        return $this->_pageFactory->create();
    }
}