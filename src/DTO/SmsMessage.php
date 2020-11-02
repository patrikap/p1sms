<?php

namespace Patrikap\P1sms\DTO;


use RuntimeException;

/**
 * Class SmsMessage
 *
 * @project p1sms
 * @date 16.06.2020 22:37
 * @author Konstantin.K
 */
class SmsMessage extends AbstractMessage
{
    /**
     * SmsMessage constructor.
     * @param string $from
     * @param string $to
     * @param string $text
     */
    public function __construct(string $from, string $to, string $text)
    {
        $this->setSender($from)
            ->setPhone($to)
            ->setText($text)
            ->setChannel(self::CHAR_CHANNEL);
    }

    /** @inheritDoc */
    protected function validateField(): bool
    {
        if (!$this->phone || !$this->channel || !$this->sender) {
            throw new RuntimeException('Not valid data');
        }

        return true;
    }
}
