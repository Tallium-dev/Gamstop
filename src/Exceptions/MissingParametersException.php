<?php

namespace Yaro\Gamstop\Exceptions;

class MissingParametersException extends GamstopBaseException
{

    public function __construct($message = 'GAMSTOP: missing parameters', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}