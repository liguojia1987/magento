<?php
namespace Qianrui\Helloworld\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        //echo "Hello World";exit;

        // 使用layout生成页面
        return $this->_pageFactory->create();
    }
}