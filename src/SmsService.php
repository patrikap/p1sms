<?php

namespace Patrikap\P1sms;

use Exception;
use Patrikap\P1sms\DTO\CreateRequest;
use Patrikap\P1sms\DTO\SmsMessage;

/**
 * Class SmsService
 *
 * Base class for service business logic
 *
 * @project p1sms
 * @date 15.06.2020 21:59
 * @author Konstantin.K
 */
class SmsService
{
    const SEND_SMS_URL = 'https://admin.p1sms.ru/apiSms/create';
    protected $apiKey;
    protected $dataProvider;

    /**
     * SmsService constructor.
     * @param $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->dataProvider = new DataProvider();
    }

    /**
     * @param $from
     * @param $to
     * @param $text
     * @param null $webHookUrl
     * @throws Exception
     */
    public function sendMessage($from, $to, $text, $webHookUrl = null)
    {
        $message = new SmsMessage($from, $to, $text);
        $request = (new CreateRequest($this->apiKey))
            ->addMessage($message);
        if ($webHookUrl) {
            $request->setWebhookUrl($webHookUrl);
        }
        return $this->dataProvider->setUrl(static::SEND_SMS_URL)
            ->setRequest($request)
            ->execute()
            ->getResponse();
    }
}
