<?php

namespace vvovnenko\Payboutique\Client;


abstract class ResponseAbstract
{
    /**
     * @var string
     */
    protected $rawData;

    /**
     * ID of the user in Payboutique system, provided by Payboutique team
     * Same as in the request message
     * @var string
     */
    protected $userId;

    /**
     * The current time at the moment of message submission
     * @var \DateTime
     */
    protected $time;

    /**
     * The type of request
     * @var string
     */
    protected $type;

    /**
     * @var bool
     */
    protected $success;

    /**
     * @var array
     */
    protected $errors = array();

    /**
     * @param string $rawData
     */
    public function __construct($rawData)
    {
        $this->rawData = $rawData;

        $xmlObject = new \SimpleXMLElement($rawData);

        $this->userId = (string)$xmlObject->Header->Identity->UserID;
        $this->time = new \DateTime((string)$xmlObject->Header->Time);

        $body = $xmlObject->Body;

        $this->type = (string)$body['type'];

        $errors = $body->xpath('//Error');

        if (is_array($errors)
            && !empty($errors)
        ) {
            $this->success = false;
            foreach ($errors as $error) {
                $this->errors[(string)$error->ErrorID] = (string)$error->ErrorMessage;
            }
        } else {
            $this->success = true;
            $this->mapBody($body[0]);
        }

    }

    /**
     * @return string Fully qualified name of the class
     */
    public static function className()
    {
        return get_called_class();
    }

    /**
     * @param \SimpleXMLElement $body
     * @return void
     */
    abstract protected function mapBody(\SimpleXMLElement $body);

    /**
     * @return string
     */
    public function getRawData()
    {
        return $this->rawData;
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }


}