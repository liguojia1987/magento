<?php
namespace Qianrui\Helloworld\Model;

use Qianrui\Helloworld\Api\ShipmentInterface;

class Shipment implements ShipmentInterface
{
    /**
     * @var \Magento\Framework\Webapi\Rest\Request
     */
    protected $request;
    /**
     * @param \Magento\Framework\Webapi\Rest\Request $request
     */
    public function __construct(
        \Magento\Framework\Webapi\Rest\Request $request
    ) {
        $this->request = $request;
    }

    public function getList(){
        return $this->getShipments();
    }

    public function getInfo($id){
        $list = $this->getShipments();

        return $list[$id] ?? [];
    }

    public function addInfo(){
        $params = $this->request->getBodyParams();
        print_r($params);
        return true;
    }

    private function getShipments(){
        $list[] = ['id'=>1, 'name'=>'one'];
        $list[] = ['id'=>2, 'name'=>'two'];
        $list[] = ['id'=>3, 'name'=>'three'];

        return $list;
    }
}