<?php

namespace Patrikap\P1sms\DTO;

use Exception;
use Patrikap\P1sms\DTO\Contracts\ArrayAble;

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
    protected $apiKey;

    public function __construct($apiKey)
    {
        if (is_string($apiKey)) {
            $this->apiKey = $apiKey;
        } else {
            throw new Exception('Api KEY should be a string');
        }
    }

    /** @inheritDoc */
    public function getData()
    {
        return [
            'apiKey' => $this->apiKey,
        ];
    }
}
