<?php

namespace llomgui\Wootrade\Http;

class Request
{
    const METHOD_GET    = 'GET';
    const METHOD_POST   = 'POST';
    const METHOD_PUT    = 'PUT';
    const METHOD_DELETE = 'DELETE';

    protected $method;
    protected $baseUri;
    protected $uri;
    protected $requestUri;
    protected $headers = [];
    protected $params = [];
    protected $bodyParams = null;

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod($method): void
    {
        $this->method = strtoupper($method);
    }

    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    public function setBaseUri($baseUri): void
    {
        $this->baseUri = $baseUri ? rtrim($baseUri, '/') : null;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function setUri($uri): void
    {
        $this->uri = rtrim($uri, '/');
    }

    public function getRequestUri(): string
    {
        if ($this->requestUri) {
            return $this->requestUri;
        }

        // GET: move parameters into query
        if ($this->getMethod() == self::METHOD_GET && !empty($this->params)) {
            $query = http_build_query($this->params);
            if ($query !== '') {
                $this->uri .= strpos($this->uri, '?') === false ? '?' : '&';
                $this->uri .= $query;
            }
        }

        $url = $this->baseUri . $this->uri;
        $this->requestUri = substr($url, strpos($url, '/', 8));
        return $this->requestUri;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders($headers): void
    {
        $this->headers = $headers;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    public function getBodyParams(): array
    {
        if ($this->bodyParams === null) {
            if ($this->getMethod() == self::METHOD_GET) {
                $this->bodyParams = [];
            } else {
                $this->bodyParams = empty($this->params) ? [] : $this->params;
            }
        }
        return $this->bodyParams;
    }

    public function __toString(): string
    {
        $str = $this->getMethod() . ' ' . $this->getRequestUri();
        $str .= ' with headers=' . json_encode($this->getHeaders(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $str .= ' with body=' . json_encode($this->getBodyParams(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return $str;
    }
}
