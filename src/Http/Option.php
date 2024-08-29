<?php

namespace Aika\Utils\Http;

class Option
{
    protected $options = [];

    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(array $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function setHeaders(array $header): self
    {
        $this->options['headers'] = $header;

        return $this;
    }

    public function getHeaders(): array
    {
        return $this->options['headers'] ?? [];
    }

    public function addHeader(string $name, $value): self
    {
        if (!isset($this->options['headers'])) $this->options['headers'] = [];
        $this->options['headers'][$name] = $value;

        return $this;
    }

    public function getHeader(string $name)
    {
        return $this->options['headers'][$name] ?? null;
    }

    public function set(string $name, $value): self
    {
        $this->options[$name] = $value;

        return $this;
    }

    public function get(string $name)
    {
        return $this->options[$name] ?? null;
    }

    public function verifySSL(bool $verify = false): self
    {
        return $this->set('verify', $verify);
    }

    public function addFormParams(string $name, $value): self
    {
        if (!isset($this->options['form_params'])) $this->options['form_params'] = [];

        $this->options['form_params'][$name] = $value;

        return $this;
    }

    public function setBody(string $content): self
    {
        return $this->set('body', $content);
    }

    public function setJson(array $data): self
    {
        return $this->set('json', $data);
    }

    public function addQuery(string $name, string $value): self
    {
        if (!isset($this->options['query'])) $this->options['query'] = [];

        $this->options['query'][$name] = $value;

        return $this;
    }
}