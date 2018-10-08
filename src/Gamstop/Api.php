<?php

namespace Yaro\Gamstop\Gamstop;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use Yaro\Gamstop\Exceptions\ApiKeyInvalidException;
use Yaro\Gamstop\Exceptions\MissingParametersException;
use Yaro\Gamstop\Exceptions\NetworkingErrorException;
use Yaro\Gamstop\Exceptions\NonPostCallException;
use Yaro\Gamstop\Exceptions\RateLimitedException;
use Yaro\Gamstop\Interfaces\GamstopCheckableInterface;

class Api
{
    /**
     * @var Client
     */
    private $client;
    private $apiKey;
    private $headers = [];
    private $baseUri;

    public function __construct($apiKey, $base_uri)
    {
        $this->apiKey = $apiKey;
        if (!$this->apiKey) {
            throw new ApiKeyInvalidException();
        }
        $this->baseUri = $base_uri;

        $this->headers = [
            'X-API-Key' => $this->apiKey,
        ];

        $this->client = new Client([
            'base_uri'    => $this->baseUri,
            'timeout'     => 2,
            'http_errors' => false,
        ]);
    }

    public function check(GamstopCheckableInterface $user)
    {
        return $this->checkParams(
            $user->getGamstopFirstName(),
            $user->getGamstopLastName(),
            $user->getGamstopDateOfBirth(),
            $user->getGamstopEmail(),
            $user->getGamstopPostCode(),
            $user->getGamstopXTraceId()
        );
    }

    public function checkParams($firstName, $lastName, $dateOfBirth, $email, $postcode, $xTraceId = null)
    {
        $headers = $this->headers;
        if ($xTraceId) {
            $headers = $headers + ['X-Trace-Id' => $xTraceId];
        }

        try {
            $response = $this->client->request(
                'POST',
                '/',
                [
                    'headers' => $headers,
                    'form_params' => [
                        'firstName' => $firstName,
                        'lastName' => $lastName,
                        'dateOfBirth' => $dateOfBirth,
                        'email' => $email,
                        'postcode' => $postcode,
                    ]
                ]
            );
        } catch (TransferException $e) {
            throw new NetworkingErrorException($e->getMessage());
        }

        switch ($response->getStatusCode()) {
            case 200:
                return new Response($response);
            case 400:
                throw new MissingParametersException();
            case 403:
                throw new ApiKeyInvalidException();
            case 405:
                throw new NonPostCallException();
            case 429:
                throw new RateLimitedException();
        }
    }

}
