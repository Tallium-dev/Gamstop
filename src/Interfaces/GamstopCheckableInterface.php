<?php

namespace Yaro\Gamstop\Interfaces;

interface GamstopCheckableInterface
{
    public function getGamstopFirstName();
    public function getGamstopLastName();
    public function getGamstopDateOfBirth();
    public function getGamstopEmail();
    public function getGamstopPostCode();
    public function getGamstopXTraceId();
}