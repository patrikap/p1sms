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
    protected const CHAR_CHANNEL = 'char';
    /** @var string[] поддерживаемые каналы сообщений  (digit, char, viber, vk, telegram) */
    private array $channels = [self::CHAR_CHANNEL];
    /** @var string Номер телефона required */
    protected string $phone;
    /** @var string Текст сообщения */
    protected string $text;
    /** @var string|null Ссылка для подстановки */
    protected ?string $link = null;
    /** @var string Канал сообщений required */
    protected string $channel;
    /** @var string Имя отправителя required */
    protected string $sender;
    /** @var int|null Количество секунд Unix timestamp */
    protected ?int $plannedAt = null;
    /** @var int|null ID схемы каскадных смс */
    protected ?int $cascadeSchemeId = null;


    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone(string $phone): self
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
    public function setText(string $text): self
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
    public function setLink(string $link): self
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
    protected function setChannel(string $channel): self
    {
        if (is_string($channel) && in_array($channel, $this->channels, true)) {
            $this->channel = $channel;
        }

        return $this;
    }

    /**
     * @param string $sender
     * @return $this
     */
    public function setSender(string $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * @param DateTimeInterface $plannedAt
     * @return $this
     */
    public function setPlannedAt(DateTimeInterface $plannedAt): self
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
    public function setCascadeSchemeId(int $cascadeSchemeId): self
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
    abstract protected function validateField(): bool;

    /**
     * получает данные
     *
     * @return mixed
     * @throws Exception
     */
    public function getData(): array
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
