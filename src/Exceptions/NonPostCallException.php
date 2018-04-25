<?php

namespace Yaro\Gamstop\Exceptions;

class NonPostCallException extends GamstopBaseException
{

    public function __construct($message = 'non-POST call', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
