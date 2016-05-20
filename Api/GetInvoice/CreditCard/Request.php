<?php

namespace vvovnenko\Payboutique\Api\GetInvoice\CreditCard;

use \vvovnenko\Payboutique\Api\GetInvoice;

class Request extends GetInvoice\Request
{
    /**
     * @var string
     */
    protected $paymentMethod = 'CreditCard';

}