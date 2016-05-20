<?php

namespace vvovnenko\Payboutique\Client;


abstract class RequestAbstract
{
    /**
     * ID of the user in Payboutique system, provided by Payboutique team
     * @var string
     */
    protected $userId;

    /** @var  string Request signature */
    protected $signature;

    /**
     * The current time at the moment of message submission in the format of  ISO 8601: YYYY­MM­DDTHH:mm:ss+­hh
     * Message is considered valid if it is accepted by Payboutique 5 minutes
     * before/after the moment supplied in this field.
     * @var string
     */
    protected $time;

    /**
     * @var string
     */
    protected $live;

    /**
     * @var string
     */
    protected $url;

    public function __construct()
    {
        $this->init();
    }

    protected function init()
    {
        $this->time = date("Ymd\TH:i:sP");
        $this->url = 'https://merchant.payb.lv/xml_service';
    }

    /**
     * @return string
     */
    public function getBody()
    {
        $xml =  '<Message version="0.5">';
        $xml .= '<Header>';
        $xml .= '<Identity>';
        $xml .= self::xmlNode('UserID', $this->userId);
        $xml .= self::xmlNode('Signature', $this->signature);
        $xml .= '</Identity>';
        $xml .= self::xmlNode('Time', $this->time);
        $xml .= '</Header>';
        $xml .= $this->makeBody();
        $xml .= '</Message>';

        return $xml;
    }

    /**
     * The __toString method allows a class to decide how it will react when it is converted to a string.
     *
     * @return string
     * @link http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.tostring
     */
    public function __toString()
    {
        return $this->getBody();
    }

    /**
     * @return string
     */
    abstract protected function makeBody();

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param string $signature
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param bool $isLive
     */
    public function setLive($isLive)
    {
        $this->live = $isLive? 'true' : '';
    }

    /**
     * @param string $name
     * @param string|int|float $value
     *
     * @return string
     */
    protected static function xmlNode($name, $value)
    {
        return !empty($value) || is_numeric($value) ? '<' . $name . '>' . $value . '</' . $name . '>' : '';
    }

    /**
     * @param string $name
     * @param string|int|float $value
     *
     * @return string
     */
    protected static function xmlAttr($name, $value)
    {
        return !empty($value) || is_numeric($value) ? $name . '="' . $value . '"' : '';
    }

    /**
     * @return string
     */
    abstract public function getResponseClassName();
}