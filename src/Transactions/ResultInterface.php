<?php

namespace Aika\Utils\Transactions;

interface ResultInterface
{
    public function setStatus(int $status): self;
    public function getStatus(): int;
    public function getStatusText(): string;
    public function isSuccess(): bool;
    public function isWarning(): bool;
    public function isError(): bool;
    public function setMessage(string $message, ...$args): self;
    public function getMessage(): ?string;
    public function setData($data): self;
    public function getData();
    public function toArray(): array;
}