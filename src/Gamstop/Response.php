<?php

namespace Yaro\Gamstop\Gamstop;

use Psr\Http\Message\ResponseInterface;

class Response
{
    const EXCLUSION_HEADER = 'X-Exclusion';
    const UNIQUE_ID_HEADER = 'X-Unique-Id';

    const REGISTERED_AND_EXCLUDED_EXCLUSION_TYPE = 'Y';
    const PREVIOUSLY_EXCLUDED_EXCLUSION_TYPE     = 'P';
    const NOT_REGISTERED_EXCLUSION_TYPE          = 'N';
    const DEFAULT_EXCLUSION_TYPE                 = 'N';


    private $response;
    private $exclusionType;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;

        $header = $this->response->getHeader(self::EXCLUSION_HEADER);
        $exclusion = array_shift($header);
        $this->exclusionType = $exclusion ?: self::DEFAULT_EXCLUSION_TYPE;
    }

    public function isAllowed()
    {
        $isNotRegistered = $this->exclusionType == self::NOT_REGISTERED_EXCLUSION_TYPE;
        $isPreviouslyExcluded = $this->exclusionType == self::PREVIOUSLY_EXCLUDED_EXCLUSION_TYPE;

        return $isNotRegistered || $isPreviouslyExcluded;
    }

    public function isBlocked()
    {
        return $this->exclusionType == self::REGISTERED_AND_EXCLUDED_EXCLUSION_TYPE;
    }

    public function getId()
    {
        $header = $this->response->getHeader(self::UNIQUE_ID_HEADER);
        
        return array_shift($header);
    }

    public function getExclusionType()
    {
        return $this->exclusionType;
    }

}
