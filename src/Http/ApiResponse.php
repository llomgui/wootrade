<?php

namespace llomgui\Wootrade\Http;

use llomgui\Wootrade\ApiCode;
use llomgui\Wootrade\Exceptions\BusinessException;
use llomgui\Wootrade\Exceptions\HttpException;

class ApiResponse
{
    protected $httpResponse;
    protected $body;

    public function __construct(Response $response)
    {
        $this->httpResponse = $response;
    }

    public function getBody(): array
    {
        if (is_null($this->body)) {
            $this->body = $this->httpResponse->getBody(true);
        }
        return $this->body;
    }

    public function getApiCode(): string
    {
        $body = $this->getBody();
        return isset($body['code']) ? $body['code'] : '';
    }

    public function getApiMessage(): string
    {
        $body = $this->getBody();
        return isset($body['message']) ? $body['message'] : '';
    }

    public function getHttpResponse(): Response
    {
        return $this->httpResponse;
    }

    public function isSuccessful(): bool
    {
        $body = $this->getBody();
        if ($this->httpResponse->isSuccessful()) {
            return isset($body['success']) ? $body['success'] : false;
        }
        return false;
    }

    public function mustSuccessful(): void
    {
        if (!$this->httpResponse->isSuccessful()) {
            $msg = sprintf(
                '[HTTP] Failure: status code is NOT 200, %s %s with body=%s, respond code=%d body=%s',
                $this->httpResponse->getRequest()->getMethod(),
                $this->httpResponse->getRequest()->getRequestUri(),
                json_encode($this->httpResponse->getRequest()->getBodyParams(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                $this->httpResponse->getStatusCode(),
                json_encode($this->httpResponse->getBody(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
            );
            $exception = new HttpException($msg, $this->httpResponse->getStatusCode());
            $exception->setRequest($this->httpResponse->getRequest());
            $exception->setResponse($this->httpResponse);
            throw $exception;
        }

        if (!$this->isSuccessful()) {
            $msg = sprintf(
                '[API] Failure: request is NOT a success, %s %s with body=%s, respond code=%s message="%s" body=%s',
                $this->httpResponse->getRequest()->getMethod(),
                $this->httpResponse->getRequest()->getRequestUri(),
                json_encode($this->httpResponse->getRequest()->getBodyParams(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                $this->getApiCode(),
                $this->getApiMessage(),
                json_encode($this->httpResponse->getBody(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
            );
            $exception = new BusinessException($msg, is_numeric($this->getApiCode()) ? $this->getApiCode() : 110);
            $exception->setResponse($this);
            throw $exception;
        }
    }

    public function getApiData(): mixed
    {
        $this->mustSuccessful();
        $body = $this->getBody();
        return $body;
    }
}
