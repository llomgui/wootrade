<?php

namespace llomgui\Wootrade\Http;

abstract class BaseHttp
{
    protected $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }
}
