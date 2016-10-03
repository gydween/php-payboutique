<?php

namespace vvovnenko\Payboutique\Api\FundTransfer;


use vvovnenko\Payboutique\Client\ResponseAbstract;

class Response extends ResponseAbstract
{
    /**
     * Same as in the request message
     * @var string
     */
    protected $payeeCurrency;

    /**
     * Same as in the request message, unless a test value was submitted in AccountID.
     * @var string
     */
    protected $live;

    /**
     * Transaction amount in MerchantCurrency, calculated by Payboutique
     * @var float
     */
    protected $amountPayeeCurrency;

    /**
     * Same as in the request message
     * @var string
     */
    protected $merchantCurrency;

    /**
     * Same as in the request message
     * @var float
     */
    protected $amountMerchantCurrency;

    /**
     * Same as in the request message
     * @var string
     */
    protected $merchantId;

    /**
     * Same as in the request message
     * @var string
     */
    protected $orderId;

    /**
     * Description of the submitted order (up to 100 characters, HTML-encoded),
     * which includes the order description template
     * @var string
     */
    protected $description;

    /**
     * Same as in the request message
     * @var string
     */
    protected $merchantReference;

    /**
     * Same as in the request message
     * @var string
     */
    protected $label;

    /**
     * Same as in the request message
     * @var string
     */
    protected $paymentMethod;

    /**
     * Current transaction status, initially equal “created"
     * @var string
     */
    protected $status;

    /**
     * Transaction reference assigned by Payboutique
     * @var string
     */
    protected $referenceId;

    /**
     * @var float
     */
    protected $balanceMerchantCurrency;

    /**
     * @param \SimpleXMLElement $body
     * @return void
     */
    protected function mapBody(\SimpleXMLElement $body)
    {
        $this->live = (string)$body['live'];

        if (isset($body->Order)) {
            $order = $body->Order;
            $this->paymentMethod = (string)$order['paymentMethod'];
            $this->payeeCurrency = (string)$order['payeeCurrency'];
            $this->balanceMerchantCurrency = (float)$order['balanceMerchantCurrency'];
            $this->amountPayeeCurrency = (float)$order->AmountPayeeCurrency;
            $this->merchantCurrency = (string)$order->MerchantCurrency;
            $this->amountMerchantCurrency = (float)$order->AmountMerchantCurrency;
            $this->merchantId = (string)$order->MerchantID;
            $this->orderId = (string)$order->OrderID;
            $this->description = (string)$order->Description;
            $this->merchantReference = (string)$order->MerchantReference;
            $this->label = (string)$order->Label;
            $this->status = (string)$order->Status;
            $this->referenceId = (string)$order->ReferenceID;
        }
    }

    /**
     * @return string
     */
    public function getReferenceId()
    {
        return $this->referenceId;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getMerchantReference()
    {
        return $this->merchantReference;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @return string
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @return float
     */
    public function getAmountMerchantCurrency()
    {
        return $this->amountMerchantCurrency;
    }

    /**
     * @return string
     */
    public function getMerchantCurrency()
    {
        return $this->merchantCurrency;
    }

    /**
     * @return float
     */
    public function getAmountPayeeCurrency()
    {
        return $this->amountPayeeCurrency;
    }

    /**
     * @return string
     */
    public function getLive()
    {
        return $this->live;
    }

    /**
     * @return string
     */
    public function getPayeeCurrency()
    {
        return $this->payeeCurrency;
    }

    /**
     * @return float
     */
    public function getBalanceMerchantCurrency()
    {
        return $this->balanceMerchantCurrency;
    }
}