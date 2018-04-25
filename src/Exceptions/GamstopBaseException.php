<?php

namespace Yaro\Gamstop\Exceptions;

class GamstopBaseException extends \Exception
{

    public function __construct($message = '', $code = 0, \Throwable $previous = null)
    {
        $message = 'GAMSTOP: '. $message;

        parent::__construct($message, $code, $previous);
    }

}