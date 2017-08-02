<?php

namespace vvovnenko\Payboutique\Api\FundTransfer;


use vvovnenko\Payboutique\Client\RequestAbstract;

abstract class Request extends RequestAbstract
{
    /**
     * @var string
     */
    protected $paymentMethod;

    /**
     * The currency in which the payout should be carried out
     * @var string
     */
    protected $payeeCurrency;

    /**
     * The currency in which the Merchant balance is charged
     * @var string
     */
    protected $merchantCurrency;

    /**
     * The total amount of the transfer in Merchant currency.
     * @var float
     */
    protected $amountMerchantCurrency;

    /**
     * ID of the merchant in Payboutique system, provided by Payboutique team
     * @var string
     */
    protected $merchantId;

    /**
     * ID of the submitted order assigned by the merchant. It must be unique number.
     * @var string
     */
    protected $orderId;

    /**
     * The description of the transaction
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $label;

    /**
     * ID of the payee account
     * @var string
     */
    protected $accountId;

    /**
     * First name of the payee
     * @var string
     */
    protected $firstName;

    /**
     * Middle name of the payee
     * @var string
     */
    protected $middleName;

    /**
     * Last name of the payee
     * @var string
     */
    protected $lastName;

    /**
     * Date of birth of the payee
     * @var \DateTime
     */
    protected $birthDate;

    /**
     * Place of birth of the payee
     * @var string
     */
    protected $birthPlace;

    /**
     * Always use: 21
     * @var int
     */
    protected $docType = 21;

    /**
     * Use only digits from passport number, without spaces or special symbols
     * @var string
     */
    protected $docNumber;

    /**
     * Year of issuance of the payee
     * @var int
     */
    protected $docIssueYear;

    /**
     * Month of issuance of the payee
     * @var int
     */
    protected $docIssueMonth;

    /**
     * Day of issuance of the payee
     * @var int
     */
    protected $docIssueDay;

    /**
     * Payee's passport issuing authority
     * @var string
     */
    protected $docIssueBy;

    /**
     * Full cardholder's phone number (without “+” symbol)
     * @var string
     */
    protected $phone;

    /**
     * Payee's address
     * @var string
     */
    protected $address;

    /**
     * Payee's city name (up to 30 characters)
     * @var string
     */
    protected $city;

    /**
     * Payee's country of residence (2-letter ISO code)
     * @var string
     */
    protected $country;

    /**
     * Payee's zip code
     * @var string
     */
    protected $zip;

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
        $xml =  '<Body type="FundTransfer" preProcessing="false" ' . self::xmlAttr('live', $this->live) . '>';
        $xml .= '<Order '
            . self::xmlAttr('paymentMethod', $this->paymentMethod)
            . ' '
            . self::xmlAttr('payeeCurrency', $this->payeeCurrency)
            . ' >';
        $xml .= self::xmlNode('MerchantID', $this->merchantId);
        $xml .= self::xmlNode('OrderID', $this->orderId);
        $xml .= self::xmlNode('AmountMerchantCurrency', $this->amountMerchantCurrency);
        $xml .= self::xmlNode('MerchantCurrency', $this->merchantCurrency);
        $xml .= self::xmlNode('Label', $this->label);
        $xml .= self::xmlNode('Description', $this->description);
        $xml .= '<Payee>';
        $xml .= self::xmlNode('AccountID', $this->accountId);
        $xml .= self::xmlNode('LastName', $this->lastName);
        $xml .= self::xmlNode('FirstName', $this->firstName);
        $xml .= self::xmlNode('MiddleName', $this->middleName);
        $xml .= self::xmlNode('BirthDate', $this->birthDate?$this->birthDate->format('d.m.Y'):'');
        $xml .= self::xmlNode('BirthPlace', $this->birthPlace);
        $xml .= self::xmlNode('DocType', $this->docType);
        $xml .= self::xmlNode('DocNumber', $this->docNumber);
        $xml .= self::xmlNode('DocIssueYear', $this->docIssueYear);
        $xml .= self::xmlNode('DocIssueMonth', $this->docIssueMonth);
        $xml .= self::xmlNode('DocIssueDay', $this->docIssueDay);
        $xml .= self::xmlNode('DocIssueBy', $this->docIssueBy);
        $xml .= self::xmlNode('Phone', $this->phone);
        $xml .= self::xmlNode('Address', $this->address);
        $xml .= self::xmlNode('City', $this->city);
        $xml .= self::xmlNode('Country', $this->country);
        $xml .= self::xmlNode('Zip', $this->zip);
        $xml .= $this->makePayeeAdditionalBodyData();
        $xml .= '</Payee>';
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
     * @param string $paymentMethod
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @param string $payeeCurrency
     */
    public function setPayeeCurrency($payeeCurrency)
    {
        $this->payeeCurrency = $payeeCurrency;
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
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @param string $accountId
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
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
     * @param \DateTime $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @param string $birthPlace
     */
    public function setBirthPlace($birthPlace)
    {
        $this->birthPlace = $birthPlace;
    }

    /**
     * @param int $docType
     */
    public function setDocType($docType)
    {
        $this->docType = $docType;
    }

    /**
     * @param string $docNumber
     */
    public function setDocNumber($docNumber)
    {
        $this->docNumber = $docNumber;
    }

    /**
     * @param int $docIssueYear
     */
    public function setDocIssueYear($docIssueYear)
    {
        $this->docIssueYear = $docIssueYear;
    }

    /**
     * @param int $docIssueMonth
     */
    public function setDocIssueMonth($docIssueMonth)
    {
        $this->docIssueMonth = $docIssueMonth;
    }

    /**
     * @param int $docIssueDay
     */
    public function setDocIssueDay($docIssueDay)
    {
        $this->docIssueDay = $docIssueDay;
    }

    /**
     * @param string $docIssueBy
     */
    public function setDocIssueBy($docIssueBy)
    {
        $this->docIssueBy = $docIssueBy;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
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
     * @param string $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    protected function makePayeeAdditionalBodyData() {
        return '';
    }
}