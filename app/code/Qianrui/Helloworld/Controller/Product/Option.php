<?php
namespace Qianrui\Helloworld\Controller\Product;

class Option extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    /**
     * @var \Qianrui\Helloworld\Model\Logger
     */
    protected $_logger;

    protected $cache;

    protected $cacheState;

    protected $serializer;

    protected $typeList;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Qianrui\Helloworld\Model\Logger\Logger $logger,
        \Magento\Framework\App\CacheInterface $cache,
        \Magento\Framework\App\Cache\StateInterface $cacheState,
        \Magento\Framework\Serialize\Serializer\Json $serializer,
        \Magento\Framework\App\Cache\TypeListInterface $typeList
    ){
        parent::__construct($context);

        $this->_pageFactory = $pageFactory;
        $this->_logger = $logger;
        $this->cache = $cache;
        $this->cacheState = $cacheState;
        $this->serializer = $serializer;
        $this->typeList = $typeList;
    }

    public function execute()
    {
        $cacheKey  = \Qianrui\Helloworld\Model\Cache\Type\ProductOption::TYPE_IDENTIFIER;
        $cacheTag  = \Qianrui\Helloworld\Model\Cache\Type\ProductOption::CACHE_TAG;

        $option = [
            'id' => 1,
            'value' => 'xiaomi'
        ];

        // 启用
        if($this->cacheState->isEnabled()) {
            // 缓存数据
            $this->cache->save(
                $this->serializer->serialize($option),
                $cacheKey,
                [$cacheTag],
                86400
            );
        }

        // 获取数据
        $data = $this->serializer->unserialize($this->cache->load($cacheKey));
        print_r($data);

        // 清除缓存
        $this->typeList->cleanType(\Qianrui\Helloworld\Model\Cache\Type\ProductOption::TYPE_IDENTIFIER);

        // 获取数据
        var_dump($this->cache->load($cacheKey));
    }
}
