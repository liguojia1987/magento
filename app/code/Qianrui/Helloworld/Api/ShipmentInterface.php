<?php
namespace Qianrui\Helloworld\Api;

interface ShipmentInterface
{
    /**
     * @return mixed
     */
    public function getList();

    /**
     * @param int $id
     * @return mixed
     */
    public function getInfo($id);
}
