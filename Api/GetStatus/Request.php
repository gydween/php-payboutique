<?php

namespace vvovnenko\Payboutique\Api\GetStatus;

use vvovnenko\Payboutique\Client\RequestAbstract;

class Request extends RequestAbstract
{
    /**
     * @var string
     */
    protected $referenceId;

    /**
     * @return string
     */
    protected function makeBody()
    {
        $xml =  '<Body type="getStatus">';
        $xml .= '<Order >';
        $xml .= self::xmlNode('ReferenceID', $this->referenceId);
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
     * @param string $referenceId
     */
    public function setReferenceId($referenceId)
    {
        $this->referenceId = $referenceId;
    }
}