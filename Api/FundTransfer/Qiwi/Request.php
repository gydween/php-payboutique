<?php

namespace vvovnenko\Payboutique\Api\FundTransfer\Qiwi;

use vvovnenko\Payboutique\Api\FundTransfer;

class Request extends FundTransfer\Request
{
    protected $paymentMethod = 'Qiwi';
}