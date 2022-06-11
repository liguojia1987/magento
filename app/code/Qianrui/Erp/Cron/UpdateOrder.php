<?php

namespace Qianrui\Erp\Cron;

class UpdateOrder
{
    protected $service;

    public function __construct(
        \Qianrui\Erp\Api\ServiceInterface $service
    ){
        $this->service = $service;
    }

    public function execute()
    {
        $data = [
            'type' => 'update_order'
        ];
        $this->service->call($data);
    }
}
