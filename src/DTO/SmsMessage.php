<?php

namespace Patrikap\P1sms\DTO;


use Exception;

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
    public function __construct($from, $to, $text)
    {
        $this->setSender($from)
            ->setPhone($to)
            ->setText($text)
            ->setChannel(self::CHAR_CHANNEL);
    }

    /** @inheritDoc */
    protected function validateField()
    {
        if (!$this->phone || !$this->channel || !$this->sender) {
            throw new Exception('Not valid data');
        }

        return true;
    }
}
