<?php

namespace llomgui\Wootrade\Http;

class Response
{
    protected $request;
    protected $headers = [];
    protected $body;
    protected $statusCode;

    public function __construct($body = '', $statusCode = 200, array $headers = [])
    {
        $this->body = $body;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getBody($decodeJson = false): mixed
    {
        return $decodeJson ? json_decode($this->body, true) : $this->body;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function isSuccessful(): bool
    {
        return $this->statusCode == 200;
    }

    public function __toString(): string
    {
        $str = 'respond ' . $this->getStatusCode();
        $str .= ' with headers=' . json_encode($this->getHeaders(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $str .= ' with body=' . json_encode($this->getBody(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return $str;
    }
}
