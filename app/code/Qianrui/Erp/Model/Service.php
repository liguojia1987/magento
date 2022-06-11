<?php

namespace Qianrui\Erp\Model;

class Service implements \Qianrui\Erp\Api\ServiceInterface
{
    protected $path;

    public function __construct(
        $path = ''
    ){
        $this->path = $path;
    }

    public function call($data)
    {
        print_r([
            'path' => $this->path,
            'params' => $data
        ]);

        // TODO: 调用api
    }
}
