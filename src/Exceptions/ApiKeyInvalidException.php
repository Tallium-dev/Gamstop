<?php

namespace Yaro\Gamstop\Exceptions;

class ApiKeyInvalidException extends GamstopBaseException
{

    public function __construct($message = 'API key invalid or IP address not in range', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
