<?php

namespace Aika\Utils\Transactions;

abstract class AbstractResult implements ResultInterface
{
    const UNKNOW            = 0;
    const DONE              = 1;
    const FAILED            = 2;
    const NOT_FOUND         = 3;
    const WARNING           = 4;
    const ERROR             = 5;
    const UPDATED           = 6;
    const REFUSED           = 7;
    const NOT_IMPLEMENTED   = 8;
    const NOTHING_HAPPENED  = 9;

    const STATUS_TEXT = [
        self::UNKNOW            => 'unknow',
        self::DONE              => 'done',
        self::FAILED            => 'failed',
        self::NOT_FOUND         => 'not found',
        self::WARNING           => 'warning',
        self::ERROR             => 'error',
        self::UPDATED           => 'updated',
        self::REFUSED           => 'refused',
        self::NOT_IMPLEMENTED   => 'not implemented',
        self::NOTHING_HAPPENED  => 'nothing happened',
    ];

    const SUCCESS_STATUS = [
        self::DONE,
        self::UPDATED,
    ];

    const WARNING_STATUS = [
        self::FAILED,
        self::NOT_FOUND,
        self::WARNING,
        self::REFUSED,
        self::NOT_IMPLEMENTED,
    ];

    const ERROR_STATUS = [
        self::ERROR,
    ];

    protected $status = self::UNKNOW;
    protected $message = null;
    protected $data = null;

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getStatusText(): string
    {
        return self::STATUS_TEXT[$this->status] ?? self::STATUS_TEXT[self::UNKNOW] ?? 'unknow';
    }

    public function isSuccess(): bool
    {
        return in_array($this->status, self::SUCCESS_STATUS);
    }

    public function isWarning(): bool
    {
        return in_array($this->status, self::WARNING_STATUS);
    }

    public function isError(): bool
    {
        return in_array($this->status, self::ERROR_STATUS);
    }

    public function setMessage(string $message, ...$args): self
    {
        $this->message = count($args) > 1 ? sprintf($message, ...$args) : $message;
       
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'message' => $this->getMessage(),
            'data' => $this->getData(),
            'status_text' => $this->getStatusText(),
        ];
    }

}