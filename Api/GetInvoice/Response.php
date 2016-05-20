<?php

namespace vvovnenko\Payboutique\Api\GetInvoice;


use vvovnenko\Payboutique\Client\ResponseAbstract;

class Response extends ResponseAbstract
{
    /**
     * Same as in the request message
     * @var string
     */
    protected $buyerCurrency;

    /**
     * Same as in the request message, unless a test value was submitted in AccountID.
     * @var string
     */
    protected $live;

    /**
     * Transaction amount in MerchantCurrency, calculated by Payboutique
     * @var float
     */
    protected $amountBuyerCurrency;

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
     * URL where the buyer needs to be redirected
     * in order to proceed with the payment (HTML-encoded).
     * @var string
     */
    protected $redirectUrl;

    /**
     * URL of an iFrame which needs to be presented to the buyer
     * in order to proceed with the payment (HTML-encoded).
     * @var string
     */
    protected $iframeUrl;

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
     * Qiwi
     * @var string
     */
    protected $invoiceSplitNumber;

    /**
     * @param string $rawData
     */
    public function __construct($rawData)
    {
        parent::__construct($rawData);


    }

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
            $this->buyerCurrency = (string)$order['buyerCurrency'];
            $this->amountBuyerCurrency = (string)$order->AmountBuyerCurrency;
            $this->merchantCurrency = (string)$order->MerchantCurrency;
            $this->amountMerchantCurrency = (string)$order->AmountMerchantCurrency;
            $this->merchantId = (string)$order->MerchantID;
            $this->orderId = (string)$order->OrderID;
            $this->description = (string)$order->Description;
            $this->merchantReference = (string)$order->MerchantReference;
            $this->label = (string)$order->Label;
            $this->redirectUrl = (string)$order->RedirectURL;
            $this->iframeUrl = (string)$order->IframeURL;
            $this->status = (string)$order->Status;
            $this->referenceId = (string)$order->ReferenceID;
        }
    }

    /**
     * @return string
     */
    public function getBuyerCurrency()
    {
        return $this->buyerCurrency;
    }

    /**
     * @return string
     */
    public function getLive()
    {
        return $this->live;
    }

    /**
     * @return float
     */
    public function getAmountBuyerCurrency()
    {
        return $this->amountBuyerCurrency;
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
    public function getAmountMerchantCurrency()
    {
        return $this->amountMerchantCurrency;
    }

    /**
     * @return string
     */
    public function getMerchantId()
    {
        return $this->merchantId;
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
    public function getDescription()
    {
        return $this->description;
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
    public function getLabel()
    {
        return $this->label;
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
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    /**
     * @return string
     */
    public function getIframeUrl()
    {
        return $this->iframeUrl;
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
    public function getReferenceId()
    {
        return $this->referenceId;
    }

    /**
     * @return string
     */
    public function getInvoiceSplitNumber()
    {
        return $this->invoiceSplitNumber;
    }



}