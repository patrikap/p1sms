<?php

namespace Patrikap\P1sms\DTO;

use Exception;
use RuntimeException;

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
    protected const MAX_MESSAGES = 1000;
    /** @var string|null URL для отправки изменений статуса */
    protected ?string $webhookUrl=null;
    /** @var array sms Список сообщений */
    protected array $messages = [];

    /**
     * @param AbstractMessage $message
     * @return $this
     * @throws Exception
     */
    public function addMessage(AbstractMessage $message):self
    {
        if (count($this->messages) > self::MAX_MESSAGES) {
            throw new RuntimeException('Превышен лимит сообщений');
        }
        $this->messages[] = $message->getData();

        return $this;
    }

    /**
     * @param string $webhookUrl
     * @return $this
     */
    public function setWebhookUrl(string $webhookUrl):self
    {
        $this->webhookUrl = $webhookUrl;

        return $this;
    }

    /** @inheritDoc
     * @throws Exception
     */
    public function getData():array
    {
        if (!count($this->messages)) {
            throw new RuntimeException('Messages is empty');
        }

        return array_merge(parent::getData(), [
            'webhookUrl' => $this->webhookUrl,
            'sms'        => $this->messages,
        ]);
    }
}
