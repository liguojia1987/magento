<?php
namespace Qianrui\Helloworld\Controller\Index;

class Ajax extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}