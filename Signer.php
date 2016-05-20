<?php

namespace vvovnenko\Payboutique;


use vvovnenko\Payboutique\Client\RequestAbstract;

class Signer
{
    /**
     * Password, provided by Payboutique team
     * @var string
     */
    protected $password;

    /**
     * ID of the user in Payboutique system, provided by Payboutique team
     * @var string
     */
    protected $userId;

    /**
     * @param string $password
     * @param string $userId
     */
    public function __construct($password, $userId)
    {
        $this->password = $password;
        $this->userId = $userId;
    }

    /**
     * @param RequestAbstract $request
     */
    public function sign(RequestAbstract $request)
    {
        $signature = strtoupper(
            hash('sha512',
                strtoupper($this->userId).
                strtoupper(hash('sha512',$this->password)).
                strtoupper($request->getTime())
            )
        );

        $request->setSignature($signature);
    }
}