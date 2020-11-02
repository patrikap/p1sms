<?php

namespace Patrikap\P1sms\DTO;

use Patrikap\P1sms\DTO\Contracts\ArrayAble;
use RuntimeException;

/**
 * Class AbstractBaseRequest
 *
 * @project p1sms
 * @date 15.06.2020 22:20
 * @author Konstantin.K
 */
abstract class AbstractBaseRequest implements ArrayAble
{
    /** @var string API ключ вы можете найти в разделе «‎Настройки API»‎ */
    protected string $apiKey;

    public function __construct($apiKey)
    {
        if (is_string($apiKey)) {
            $this->apiKey = $apiKey;
        } else {
            throw new RuntimeException('Api KEY should be a string');
        }
    }

    /** @inheritDoc */
    public function getData():array
    {
        return [
            'apiKey' => $this->apiKey,
        ];
    }
}
