<?php

namespace Yaro\Gamstop\Exceptions;

class RateLimitedException extends GamstopBaseException
{

    public function __construct($message = 'GAMSTOP: rate limited', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}