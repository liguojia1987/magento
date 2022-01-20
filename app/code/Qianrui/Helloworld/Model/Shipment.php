<?php
namespace Qianrui\Helloworld\Model;

use Qianrui\Helloworld\Api\ShipmentInterface;

class Shipment implements ShipmentInterface
{
    public function getList(){
        $list[] = ['id'=>1, 'name'=>'one'];
        $list[] = ['id'=>2, 'name'=>'two'];
        $list[] = ['id'=>3, 'name'=>'three'];

        return $list;
    }

    public function getInfo($id){
        return ['id'=>2, 'name'=>'two'];
    }
}