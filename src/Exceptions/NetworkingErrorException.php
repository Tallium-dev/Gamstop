<?php

namespace Yaro\Gamstop\Exceptions;

class NetworkingErrorException extends GamstopBaseException
{

    public function __construct($message, $code = 0, \Throwable $previous = null)
    {
        parent::__construct('GAMSTOP: '. $message, $code, $previous);
    }

}