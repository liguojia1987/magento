<?php
namespace Qianrui\Helloworld\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        echo "Hello World";
        exit;
    }
}