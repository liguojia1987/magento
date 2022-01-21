<?php
namespace Qianrui\Helloworld\Api;

interface ShipmentInterface
{
    /**
     * @return array
     */
    public function getList();

    /**
     * @param int $id
     * @return array
     */
    public function getInfo($id);

    /**
     * @return boolean
     */
    public function addInfo();
}
