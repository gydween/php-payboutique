<?php

namespace vvovnenko\Payboutique\Api\GetInvoice;


use vvovnenko\Payboutique\Client\RequestAbstract;

abstract class Request extends RequestAbstract
{
    /**
     * @var string
     */
    protected $paymentMethod;

    /**
     * The preferred currency of the buyer
     * @var string
     */
    protected $buyerCurrency;

    /**
     * The currency in which the price is presented to the buyer by the merchant
     * @var string
     */
    protected $merchantCurrency;

    /**
     * The total price of the order that needs to be charged from the buyer in MerchantCurrency.
     * @var float
     */
    protected $amountMerchantCurrency;

    /**
     * ID of the merchant in Payboutique system, provided by Payboutique team
     * @var string
     */
    protected $merchantId;

    /**
     * ID of the submitted order assigned by the merchant.
     * If this field is empty then Payboutique transaction reference value is populated
     * instead in the response message.
     * @var string
     */
    protected $orderId;

    /**
     * Description of the submitted order (up to 100 characters, HTML-encoded),
     * which is included into invoice
     * @var string
     */
    protected $description;

    /**
     * Free text field that is provided in the payment confirmation postback
     * @var string
     */
    protected $merchantReference;

    /**
     * Free text field that is can be used for filtering of transaction reports
     * @var string
     */
    protected $label;

    /**
     * Free text field
     * @var string
     */
    protected $productName;

    /**
     * URL of the site where the purchase is placed
     * @var string
     */
    protected $siteAddress;

    /**
     * First name of the buyer
     * @var string
     */
    protected $firstName;

    /**
     * Middle name of the buyer
     * @var string
     */
    protected $middleName;

    /**
     * Last name of the buyer
     * @var string
     */
    protected $lastName;

    /**
     * Street address of the buyer
     * @var string
     */
    protected $address;

    /**
     * City of the buyer address
     * @var string
     */
    protected $city;

    /**
     * Country of the buyer
     * @var string
     */
    protected $country;

    /**
     * ID of the buyer account, provided by the buyer.
     * @var string
     */
    protected $accountId;

    /**
     * The URL of a page to which buyers need to be redirected upon successful payment.
     * @var string
     */
    protected $successUrl;

    /**
     * The URL of a page to which buyers need to be redirected upon unsuccessful payment.
     * @var string
     */
    protected $failureUrl;

    /**
     * The URL for submission of Payment Completion Notification
     * @var string
     */
    protected $postbackUrl;

    protected function init()
    {
        parent::init();
        $this->setLive(true);
    }

    /**
     * @return string
     */
    protected function makeBody()
    {
        $xml =  '<Body type="GetInvoice" ' . self::xmlAttr('live', $this->live) . '>';
        $xml .= '<Order '
            . self::xmlAttr('paymentMethod', $this->paymentMethod)
            . ' '
            . self::xmlAttr('buyerCurrency', $this->buyerCurrency)
            . ' >';
        $xml .= self::xmlNode('MerchantID', $this->merchantId);
        $xml .= self::xmlNode('OrderID', $this->orderId);
        $xml .= self::xmlNode('AmountMerchantCurrency', $this->amountMerchantCurrency);
        $xml .= self::xmlNode('MerchantCurrency', $this->merchantCurrency);
        $xml .= self::xmlNode('Label', $this->label);
        $xml .= self::xmlNode('SiteAddress', $this->siteAddress);
        $xml .= self::xmlNode('Description', $this->description);
        $xml .= self::xmlNode('SuccessURL', $this->successUrl);
        $xml .= self::xmlNode('FailureURL', $this->failureUrl);
        $xml .= self::xmlNode('PostbackURL', $this->postbackUrl);
        $xml .= self::xmlNode('ProductName', $this->productName);
        $xml .= '<Buyer>';
        $xml .= self::xmlNode('FirstName', $this->firstName);
        $xml .= self::xmlNode('LastName', $this->lastName);
        $xml .= self::xmlNode('MiddleName', $this->middleName);
        $xml .= self::xmlNode('AccountID', $this->accountId);
        $xml .= self::xmlNode('Address', $this->address);
        $xml .= self::xmlNode('City', $this->city);
        $xml .= self::xmlNode('Country', $this->country);
        $xml .= '</Buyer>';
        $xml .= '</Order>';
        $xml .= '</Body>';

        return $xml;
    }

    /**
     * @return string
     */
    public function getResponseClassName()
    {
        return Response::className();
    }

    /**
     * @param string $buyerCurrency
     */
    public function setBuyerCurrency($buyerCurrency)
    {
        $this->buyerCurrency = $buyerCurrency;
    }

    /**
     * @param string $merchantCurrency
     */
    public function setMerchantCurrency($merchantCurrency)
    {
        $this->merchantCurrency = $merchantCurrency;
    }

    /**
     * @param float $amountMerchantCurrency
     */
    public function setAmountMerchantCurrency($amountMerchantCurrency)
    {
        $this->amountMerchantCurrency = $amountMerchantCurrency;
    }

    /**
     * @param string $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
    }

    /**
     * @param string $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param string $merchantReference
     */
    public function setMerchantReference($merchantReference)
    {
        $this->merchantReference = $merchantReference;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @param string $productName
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    /**
     * @param string $siteAddress
     */
    public function setSiteAddress($siteAddress)
    {
        $this->siteAddress = $siteAddress;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @param string $middleName
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @param string $accountId
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     * @param string $successUrl
     */
    public function setSuccessUrl($successUrl)
    {
        $this->successUrl = $successUrl;
    }

    /**
     * @param string $failureUrl
     */
    public function setFailureUrl($failureUrl)
    {
        $this->failureUrl = $failureUrl;
    }

    /**
     * @param string $postbackUrl
     */
    public function setPostbackUrl($postbackUrl)
    {
        $this->postbackUrl = $postbackUrl;
    }

}