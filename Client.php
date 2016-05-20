<?php

namespace vvovnenko\Payboutique;


use vvovnenko\Payboutique\Client\Adapter\CurlAdapter;
use vvovnenko\Payboutique\Client\AdapterAbstract;
use vvovnenko\Payboutique\Client\RequestAbstract;
use vvovnenko\Payboutique\Client\ResponseAbstract;

class Client
{
    /**
     * ID of the user in Payboutique system, provided by Payboutique team
     * @var string
     */
    protected $userId;

    /**
     * Password, provided by Payboutique team
     * @var string
     */
    protected $password;

    /**
     * @var AdapterAbstract
     */
    protected $requestAdapter;

    /**
     * @var Signer
     */
    protected $signer;

    /**
     * @var RequestAbstract
     */
    protected $lastRequest;

    /**
     * @var ResponseAbstract
     */
    protected $lastResponse;

    /**
     * @param string $userId
     * @param string $password
     * @param AdapterAbstract $requestAdapter
     */
    public function __construct($userId, $password, AdapterAbstract $requestAdapter = null)
    {
        $this->userId = $userId;
        $this->password = $password;
        if (is_null($requestAdapter)) {
            $requestAdapter = new CurlAdapter();
        }
        $this->requestAdapter = $requestAdapter;
        $this->signer = new Signer($this->password, $this->userId);
    }

    /**
     * @param RequestAbstract $request
     * @return ResponseAbstract
     */
    public function request(RequestAbstract $request)
    {
        $this->lastRequest = $request;

        $responseContent = $this->requestAdapter->request($request);

        $responseClass = $request->getResponseClassName();

        $this->lastResponse = new $responseClass($responseContent);

        return $this->lastResponse;
    }

    /**
     * @param RequestAbstract $request
     * @return RequestAbstract
     */
    public function prepareRequest(RequestAbstract $request)
    {
        $request->setUserId($this->userId);

        $this->signer->sign($request);

        return $request;
    }

    /**
     * @return RequestAbstract
     */
    public function getLastRequest()
    {
        return $this->lastRequest;
    }

    /**
     * @return ResponseAbstract
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }


}