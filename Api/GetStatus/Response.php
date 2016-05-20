<?php

namespace vvovnenko\Payboutique\Api\GetStatus;


use vvovnenko\Payboutique\Client\ResponseAbstract;

class Response extends ResponseAbstract
{
    /**
     * The currency of the buyer
     * @var string
     */
    protected $buyerCurrency;

    /**
     * The transaction amount in BuyerCurrency
     * @var float
     */
    protected $amountBuyerCurrency;

    /**
     * Total transaction amount in BuyerCurrency for all transactions with the given OrderID.
     * In case of split payments, TotalOrderAmountMerchantCurrency equals
     * sum of all splits completed up until the current moment.
     * @var float
     */
    protected $totalAmountBuyerCurrency;

    /**
     * The currency of the merchant
     * @var string
     */
    protected $merchantCurrency;

    /**
     * The transaction amount in MerchantCurrency
     * @var float
     */
    protected $amountMerchantCurrency;

    /**
     * Total transaction amount in MerchantCurrency for all transactions with the given OrderID.
     * In case of split payments, TotalOrderAmountMerchantCurrency
     * equals sum of all splits completed up until the current moment.
     * @var float
     */
    protected $totalAmountMerchantCurrency;

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
     * URL of the site where the purchase is placed
     * @var string
     */
    protected $siteAddress;

    /**
     * Method of payment used for this transaction
     * @var string
     */
    protected $paymentMethod;

    /**
     * Current transaction status, upon payment completion it’s value is captured
     * @var string
     */
    protected $status;

    /**
     * Transaction reference assigned by Payboutique
     * @var string
     */
    protected $referenceId;

    /**
     * Date when the invoice was created
     * @var \DateTime
     */
    protected $creationDate;

    /**
     * Date when the invoice was paid
     * @var \DateTime
     */
    protected $captureDate;

    /**
     * Date when the funds are expected to be settled to merchant bank account
     * @var \DateTime
     */
    protected $settlementDate;

    /**
     * Currency in which the funds will be settled to the merchant bank account
     * @var string
     */
    protected $settlementCurrency;

    /**
     * Expected settlement amount in SettlementCurrency
     * @var float
     */
    protected $settlementAmount;

    /**
     * Total expected settlement amount in SettlementCurrency for all transactions with the given OrderID.
     * In case of split payments, TotalSettlementAmount
     * equals sum of all splits completed up until the current moment.
     * @var float
     */
    protected $totalSettlementAmount;

    /**
     * Same as in the request message, unless a test value was submitted in AccountID.
     * @var string
     */
    protected $live;

    /**
     * @param \SimpleXMLElement $body
     * @return void
     */
    protected function mapBody(\SimpleXMLElement $body)
    {

        if (isset($body->ReportedTransaction)) {
            $transaction = $body->ReportedTransaction;
            $this->buyerCurrency = (string)$transaction->BuyerCurrency;
            $this->amountBuyerCurrency = (string)$transaction->AmountBuyerCurrency;
            $this->totalAmountBuyerCurrency = (string)$transaction->TotalOrderAmountMerchantCurrency;
            $this->merchantCurrency = (string)$transaction->MerchantCurrency;
            $this->amountMerchantCurrency = (string)$transaction->AmountMerchantCurrency;
            $this->totalAmountMerchantCurrency = (string)$transaction->TotalOrderAmountMerchantCurrency;
            $this->merchantId = (string)$transaction->MerchantID;
            $this->orderId = (string)$transaction->OrderID;
            $this->description = (string)$transaction->Description;
            $this->merchantReference = (string)$transaction->MerchantReference;
            $this->label = (string)$transaction->Label;
            $this->siteAddress = (string)$transaction->SiteAddress;
            $this->paymentMethod = (string)$transaction->PaymentMethod;
            $this->status = (string)$transaction->Status;
            $this->referenceId = (string)$transaction->ReferenceID;
            $this->creationDate = new \DateTime((string)$transaction->CreationDate);
            $this->captureDate = new \DateTime((string)$transaction->CaptureDate);
            $this->settlementDate = new \DateTime((string)$transaction->SettlementDate);
            $this->settlementCurrency = (string)$transaction->SettlementCurrency;
            $this->settlementAmount = (string)$transaction->SettlementAmount;
            $this->totalSettlementAmount = (string)$transaction->TotalOrderSettlementAmount;
            $this->live = (string)$transaction->Live;
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
     * @return float
     */
    public function getAmountBuyerCurrency()
    {
        return $this->amountBuyerCurrency;
    }

    /**
     * @return float
     */
    public function getTotalAmountBuyerCurrency()
    {
        return $this->totalAmountBuyerCurrency;
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
     * @return float
     */
    public function getTotalAmountMerchantCurrency()
    {
        return $this->totalAmountMerchantCurrency;
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
    public function getSiteAddress()
    {
        return $this->siteAddress;
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
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @return \DateTime
     */
    public function getCaptureDate()
    {
        return $this->captureDate;
    }

    /**
     * @return \DateTime
     */
    public function getSettlementDate()
    {
        return $this->settlementDate;
    }

    /**
     * @return string
     */
    public function getSettlementCurrency()
    {
        return $this->settlementCurrency;
    }

    /**
     * @return float
     */
    public function getSettlementAmount()
    {
        return $this->settlementAmount;
    }

    /**
     * @return float
     */
    public function getTotalSettlementAmount()
    {
        return $this->totalSettlementAmount;
    }

    /**
     * @return string
     */
    public function getLive()
    {
        return $this->live;
    }


}