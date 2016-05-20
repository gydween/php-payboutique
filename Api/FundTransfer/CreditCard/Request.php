<?php

namespace vvovnenko\Payboutique\Api\FundTransfer\CreditCard;

use vvovnenko\Payboutique\Api\FundTransfer;

class Request extends FundTransfer\Request
{
    protected $paymentMethod = 'CreditCard';
}