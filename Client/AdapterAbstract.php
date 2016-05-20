<?php

namespace vvovnenko\Payboutique\Client;


abstract class AdapterAbstract
{
    /**
     * @param RequestAbstract $request
     * @return mixed
     */
    abstract public function request(RequestAbstract $request);
}