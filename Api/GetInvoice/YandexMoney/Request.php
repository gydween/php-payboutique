<?php

namespace vvovnenko\Payboutique\Api\GetInvoice\YandexMoney;

use \vvovnenko\Payboutique\Api\GetInvoice;

class Request extends GetInvoice\Request
{
    /**
     * @var string
     */
    protected $paymentMethod = 'YandexMoney';

}