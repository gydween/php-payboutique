<?php

namespace vvovnenko\Payboutique\Api\FundTransfer\YandexMoney;

use vvovnenko\Payboutique\Api\FundTransfer;

class Request extends FundTransfer\Request
{
    protected $paymentMethod = 'Yandex.Money';
}