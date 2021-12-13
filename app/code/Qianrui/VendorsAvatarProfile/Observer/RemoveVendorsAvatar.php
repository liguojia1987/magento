<?php
namespace Qianrui\VendorsAvatarProfile\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class RemoveVendorsAvatar implements ObserverInterface
{
    const TEMPLATE_TO_REMOVE = 'Vnecoms_VendorsAvatarProfile::avatar.phtml';

    public function execute(Observer $observer)
    {
        /** @var \Magento\Framework\View\Layout $layout */
        $layout = $observer->getLayout();
        $blocks = $layout->getAllBlocks();
        foreach ($blocks as $key => $block) {
            /** @var \Magento\Framework\View\Element\Template $block */
            if ($block->getTemplate() == self::TEMPLATE_TO_REMOVE) {
                $layout->unsetElement($key);
            }
        }
    }
}