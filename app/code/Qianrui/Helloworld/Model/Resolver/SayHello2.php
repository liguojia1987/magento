<?php
namespace Qianrui\Helloworld\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class SayHello2 implements ResolverInterface
{
    protected $_logger;

    public function __construct(
        \Qianrui\Helloworld\Model\Logger\Logger $logger
    ){
        $this->_logger = $logger;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $response = [
            'code'    => 0,
            'message' => 'hello'
        ];

        return $response;
    }
}