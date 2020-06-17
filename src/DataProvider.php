<?php

namespace Patrikap\P1sms;

use Patrikap\P1sms\DTO\AbstractBaseRequest;

/**
 * Class DataProvider
 *
 * Data provider
 *
 * @project p1sms
 * @date 15.06.2020 22:03
 * @author Konstantin.K
 */
class DataProvider
{
    protected $url;
    /** @var AbstractBaseRequest */
    protected $request;
    protected $response;

    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function setRequest(AbstractBaseRequest $request)
    {
        $this->request = $request;

        return $this;
    }

    public function execute()
    {
        if ($curl = curl_init()) {
            $json = json_encode($this->request->getData());
            //'{"apiKey": "AbCd********", "sms": [{"channel":"digit", "text": "test1", "phone": "79*********", "plannedAt": 1490612400}, {"channel":"digit", "text": "test2", "phone": "79*********", "plannedAt": 1490612400}]}';
            curl_setopt($curl, CURLOPT_URL, $this->url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'accept: application/json']);
            curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            $this->response = curl_exec($curl);
            curl_close($curl);
        }

        return $this;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
