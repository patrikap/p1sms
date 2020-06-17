<?php

namespace Patrikap\P1sms\DTO;

use Exception;

/**
 * Class CreateRequest
 *
 * @url https://admin.p1sms.ru/panel/apiinfo#getOperatorInfoNew
 * @project p1sms
 * @date 15.06.2020 22:17
 * @author Konstantin.K
 */
class CreateRequest extends AbstractBaseRequest
{
    const MAX_MESSAGES = 1000;
    /** @var string URL для отправки изменений статуса */
    protected $webhookUrl;
    /** @var array sms Список сообщений */
    protected $messages = [];

    /**
     * @param AbstractMessage $message
     * @return $this
     * @throws Exception
     */
    public function addMessage(AbstractMessage $message)
    {
        if (count($this->messages) > self::MAX_MESSAGES) {
            throw new Exception('Превышен лимит сообщений');
        }
        $this->messages[] = $message->getData();

        return $this;
    }

    /**
     * @param string $webhookUrl
     * @return $this
     */
    public function setWebhookUrl($webhookUrl)
    {
        $this->webhookUrl = $webhookUrl;

        return $this;
    }

    /** @inheritDoc */
    public function getData()
    {
        if (!count($this->messages)) {
            throw new Exception('Messages is empty');
        }

        return array_merge(parent::getData(), [
            'webhookUrl' => $this->webhookUrl,
            'sms'        => $this->messages,
        ]);
    }
}
