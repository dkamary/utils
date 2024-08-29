<?php

namespace Aika\Utils\Transactions;

class Result extends AbstractResult
{
    public function __construct(int $status = self::UNKNOW, ?string $message = null, $data = null)
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }
}