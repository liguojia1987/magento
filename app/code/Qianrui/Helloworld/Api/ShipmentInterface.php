<?php
namespace Qianrui\Helloworld\Api;

interface ShipmentInterface
{
    /**
     * @return []
     */
    public function getList();

    /**
     * @param int $id
     * @return []
     */
    public function getInfo($id);

    /**
     * @return boolean
     */
    public function addInfo();
}
