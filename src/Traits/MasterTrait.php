<?php

namespace Ordinary9843\Traits;

use Ordinary9843\Constants\MetaMasterConstant;
use GuzzleHttp\Client;

trait MasterTrait
{
    /** @var Client */
    private static $client = null;

    /** @var int */
    private $connectTimeout = 5;

    /** @var int */
    private $timeout = 5;

    /** @var array */
    private $userAgents = [];

    /**
     * @return void
     */
    private function setClient(): void
    {
        self::$client = new Client([
            'http_errors' => false,
            'connect_timeout' => $this->getConnectTimeout(),
            'timeout' => $this->getTimeout()
        ]);
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        (self::$client === null) && $this->setClient();

        return self::$client;
    }

    /**
     * @param int $connectTimeout
     * 
     * @return void
     */
    public function setConnectTimeout(int $connectTimeout): void
    {
        $this->connectTimeout = $connectTimeout;
        $this->setClient();
    }

    /**
     * @return int
     */
    public function getConnectTimeout(): int
    {
        return $this->connectTimeout;
    }

    /**
     * @param int $timeout
     * 
     * @return void
     */
    public function setTimeout(int $timeout): void
    {
        $this->timeout = $timeout;
        $this->setClient();
    }

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * @return string
     */
    public function getUserAgent(): string
    {
        if (empty($this->userAgents)) {
            $this->userAgents = MetaMasterConstant::USER_AGENTS;
            shuffle($this->userAgents);
        }

        return array_shift($this->userAgents);
    }

    /**
     * @param string $url
     * 
     * @return bool
     */
    public function hasScheme(string $url): bool
    {
        return (substr($url, 0, 7) === 'http://' || substr($url, 0, 8) === 'https://');
    }

    /**
     * @param string $url
     * 
     * @return bool
     */
    public function isValidUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    /**
     * @param string $url
     * 
     * @return string
     */
    public function parseBaseUrl(string $url): string
    {
        $parseUrl = parse_url($url);
        if (!isset($parseUrl['scheme']) || !isset($parseUrl['host'])) {
            return $url;
        }

        return $parseUrl['scheme'] . '://' . $parseUrl['host'];
    }
}
