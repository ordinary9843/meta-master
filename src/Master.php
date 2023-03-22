<?php

namespace Ordinary9843;

use Ordinary9843\Constants\MasterConstant;
use GuzzleHttp\Client;

class Master
{
    /** @var Client */
    private static $client = null;

    /** @var int */
    private $connectTimeout = 5;

    /** @var int */
    private $timeout = 5;

    /** @var string */
    private $error = '';

    /** @var array */
    private $userAgents = [];

    public function __construct()
    {
        $this->setClient();
    }

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
     * @param string $error
     * 
     * @return void
     */
    public function setError(string $error): void
    {
        $this->error = $error;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @return string
     */
    public function getUserAgent(): string
    {
        if (empty($this->userAgents)) {
            $this->userAgents = MasterConstant::USER_AGENTS;
            shuffle($this->userAgents);
        }

        return array_shift($this->userAgents);
    }
}
