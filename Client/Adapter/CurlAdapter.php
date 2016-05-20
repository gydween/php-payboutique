<?php

namespace vvovnenko\Payboutique\Client\Adapter;


use vvovnenko\Payboutique\Client\AdapterAbstract;
use vvovnenko\Payboutique\Client\RequestAbstract;
use vvovnenko\Payboutique\Exception\AdapterException;

class CurlAdapter extends AdapterAbstract
{
    /**
     * @param RequestAbstract $request
     * @return string
     * @throws AdapterException
     */
    public function request(RequestAbstract $request)
    {
        $handler = curl_init($request->getUrl());

        curl_setopt($handler, CURLOPT_POST, true);

        $postFields = http_build_query(array(
            'xml' => $request->getBody(),
        ));
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postFields);

        ob_start();
        if (!curl_exec($handler)) {
            throw new AdapterException('Error while performing request (' . curl_error($handler) . ')');
        }
        $content = ob_get_contents();
        ob_end_clean();
        curl_close($handler);

        if (trim($content) == '') {
            throw new AdapterException('No response was received from the server');
        }

        return $content;
    }

}