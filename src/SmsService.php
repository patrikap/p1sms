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
    protected const SEND_SMS_URL = 'https://admin.p1sms.ru/apiSms/create';
    protected string $apiKey;
    protected DataProvider $dataProvider;

    /**
     * SmsService constructor.
     * @param $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->dataProvider = new DataProvider();
    }

    /**
     * @param string $from
     * @param string $to
     * @param string $text
     * @param string|null $webHookUrl
     * @return mixed
     * @throws Exception
     */
    public function sendMessage(string $from, string $to, string $text, ?string $webHookUrl = null)
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
