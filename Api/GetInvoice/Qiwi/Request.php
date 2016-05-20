<?php

namespace vvovnenko\Payboutique\Api\GetInvoice\Qiwi;

use \vvovnenko\Payboutique\Api\GetInvoice;

class Request extends GetInvoice\Request
{
    /**
     * @var string
     */
    protected $paymentMethod = 'Qiwi';

}