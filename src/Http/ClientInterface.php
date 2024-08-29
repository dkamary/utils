<?php

namespace Aika\Utils\Http;

use Aika\Utils\Transactions\ResultInterface;

interface ClientInterface
{
    public function request(string $method, string $uri, Option $options): ResultInterface;
    public function get(string $uri, Option $options): ResultInterface;
    public function post(string $uri, Option $options): ResultInterface;
    public function put(string $uri, Option $options): ResultInterface;
    public function delete(string $uri, Option $options): ResultInterface;
}