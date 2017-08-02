<?php

namespace vvovnenko\Payboutique\Api\FundTransfer\BankTransfer;

use vvovnenko\Payboutique\Api\FundTransfer;

class Request extends FundTransfer\Request
{
    protected $paymentMethod = 'BankTransfer';

    /**
     * Name of the payee's bank.
     * @var string
     */
    protected $bankName;

    /**
     * City of the payee's bank.
     * @var string
     */
    protected $bankCity;

    /**
     * Bank ID (BIC) of the payee's bank (9 digits).
     * @var string
     */
    protected $bankBic;

    /**
     * Correspondent account of the payee's bank.
     * @var string
     */
    protected $bankCorAccount;

    /**
     * Country of the payee's bank (2-digit ISO code)
     * @var string
     */
    protected $bankCountry;

    /**
     * Number of the payee bank account (20 digits).
     * @var string
     */
    protected $bankAccountNumber;

    /**
     * KPP of the payee's.
     * @var string
     */
    protected $kpp;

    /**
     * INN of the payee's.
     * @var string
     */
    protected $inn;

    /**
     * @param string $bankName
     */
    public function setBankName($bankName)
    {
        $this->bankName = $bankName;
    }

    /**
     * @param string $bankCity
     */
    public function setBankCity($bankCity)
    {
        $this->bankCity = $bankCity;
    }

    /**
     * @param string $bankBic
     */
    public function setBankBic($bankBic)
    {
        $this->bankBic = $bankBic;
    }

    /**
     * @param string $bankCorAccount
     */
    public function setBankCorAccount($bankCorAccount)
    {
        $this->bankCorAccount = $bankCorAccount;
    }

    /**
     * @param string $bankCountry
     */
    public function setBankCountry($bankCountry)
    {
        $this->bankCountry = $bankCountry;
    }

    /**
     * @param string $bankAccountNumber
     */
    public function setBankAccountNumber($bankAccountNumber)
    {
        $this->bankAccountNumber = $bankAccountNumber;
    }

    /**
     * @param string $kpp
     */
    public function setKpp($kpp)
    {
        $this->kpp = $kpp;
    }

    /**
     * @param string $inn
     */
    public function setInn($inn)
    {
        $this->inn = $inn;
    }

    protected function makePayeeAdditionalBodyData()
    {
        $xml = '<Bank>';
        $xml .= self::xmlNode('BankBIC', $this->bankBic);
        $xml .= self::xmlNode('BankCorAccount', $this->bankCorAccount);
        $xml .= self::xmlNode('BankCity', $this->bankCity);
        $xml .= self::xmlNode('BankName', $this->bankName);
        $xml .= self::xmlNode('BankCountry', $this->bankCountry);
        $xml .= self::xmlNode('BankAccountNumber', $this->bankAccountNumber);
        $xml .= '</Bank>';
        $xml .= self::xmlNode('KPP', $this->kpp);
        $xml .= self::xmlNode('INN', $this->inn);

        return $xml;
    }


}