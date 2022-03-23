<?php

namespace llomgui\Wootrade\Exceptions;

class InvalidApiUriException extends \Exception
{
    protected $baseUri;
    protected $uri;

    public function getBaseUri()
    {
        return $this->baseUri;
    }

    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
    }
}
