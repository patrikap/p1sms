<?php

namespace Patrikap\P1sms\DTO;

use DateTimeInterface;
use Exception;
use Patrikap\P1sms\DTO\Contracts\ArrayAble;

/**
 * Class AbstractMessage
 *
 * @project p1sms
 * @date 15.06.2020 22:17
 * @author Konstantin.K
 */
abstract class AbstractMessage implements ArrayAble
{
    const CHAR_CHANNEL = 'char';
    /** @var string[] поддерживаемые каналы сообщений  (digit, char, viber, vk, telegram) */
    private $channels = [self::CHAR_CHANNEL];
    /** @var string Номер телефона required */
    protected $phone;
    /** @var string Текст сообщения */
    protected $text;
    /** @var string Ссылка для подстановки */
    protected $link;
    /** @var string Канал сообщений required */
    protected $channel;
    /** @var string Имя отправителя required */
    protected $sender;
    /** @var int Количество секунд Unix timestamp */
    protected $plannedAt;
    /** @var int ID схемы каскадных смс */
    protected $cascadeSchemeId;


    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        //if (is_string($phone)) {
        //    $this->phone = substr($phone, 0, 11);
        //}
        $this->phone = $phone;

        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText($text)
    {
        if (is_string($text)) {
            $this->text = $text;
        }

        return $this;
    }

    /**
     * @param string $link
     * @return $this
     */
    public function setLink($link)
    {
        if (is_string($link)) {
            $this->link = $link;
        }

        return $this;
    }

    /**
     * @param string $channel
     * @return $this
     */
    protected function setChannel($channel)
    {
        if (is_string($channel) && in_array($channel, $this->channels)) {
            $this->channel = $channel;
        }

        return $this;
    }

    /**
     * @param string $sender
     * @return $this
     */
    public function setSender($sender)
    {
        if (is_string($sender)) {
            $this->sender = $sender;
        }

        return $this;
    }

    /**
     * @param DateTimeInterface $plannedAt
     * @return $this
     */
    public function setPlannedAt($plannedAt)
    {
        if ($plannedAt instanceof DateTimeInterface) {
            $this->plannedAt = $plannedAt->getTimestamp();
        }

        return $this;
    }

    /**
     * @param int $cascadeSchemeId
     * @return $this
     */
    public function setCascadeSchemeId($cascadeSchemeId)
    {
        if (is_int($cascadeSchemeId)) {
            $this->cascadeSchemeId = $cascadeSchemeId;
        }

        return $this;
    }

    /**
     * Валидирует параметры
     *
     * @return bool
     * @throws Exception
     */
    abstract protected function validateField();

    /**
     * получает данные
     *
     * @return mixed
     */
    public function getData()
    {
        $data = [];
        $this->validateField();
        if ($this->phone) {
            $data['phone'] = $this->phone;
        }
        if ($this->text) {
            $data['text'] = $this->text;
        }
        if ($this->link) {
            $data['link'] = $this->link;
        }
        if ($this->channel) {
            $data['channel'] = $this->channel;
        }
        if ($this->sender) {
            $data['sender'] = $this->sender;
        }
        if ($this->plannedAt) {
            $data['plannedAt'] = $this->plannedAt;
        }
        if ($this->cascadeSchemeId) {
            $data['cascadeSchemeId'] = $this->cascadeSchemeId;
        }

        return $data;
    }
}
