<?php
namespace Qianrui\Swagger\Block;

class Index extends \Magento\Swagger\Block\Index
{
    public function getJsUrl($asset) : string
    {
        return $this->_assetRepo->getUrl($asset);
    }
}