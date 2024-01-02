<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Ordinary9843\Constants\MetaMasterConstant;
use Ordinary9843\Traits\MasterTrait;
use GuzzleHttp\Client;

class MasterTraitTest extends TestCase
{
    use MasterTrait;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @return void
     */
    public function testShouldInstanceOfClientWhenGetClient(): void
    {
        $this->assertInstanceOf(Client::class, $this->getClient());
    }

    /**
     * @return void
     */
    public function testShouldEqualsWhenGetConnectTimeout(): void
    {
        $connectionTimeout = 5;
        $this->setConnectTimeout($connectionTimeout);
        $this->assertEquals($connectionTimeout, $this->getConnectTimeout());
    }

    /**
     * @return void
     */
    public function testShouldEqualsWhenGetTimeout(): void
    {
        $timeout = 5;
        $this->setTimeout($timeout);
        $this->assertEquals($timeout, $this->getTimeout());
    }

    /**
     * @return void
     */
    public function testShouldContainsWhenGetUserAgent(): void
    {
        $this->assertContains($this->getUserAgent(), MetaMasterConstant::USER_AGENTS);
    }

    /**
     * @return void
     */
    public function testShouldReturnBooleanWhenHasScheme(): void
    {
        $this->assertTrue($this->hasScheme('http://google.com'));
        $this->assertTrue($this->hasScheme('https://google.com'));
        $this->assertFalse($this->hasScheme('google.com'));
    }

    /**
     * @return void
     */
    public function testShouldReturnBooleanWhenIsValidUrl(): void
    {
        $this->assertTrue($this->isValidUrl('http://google.com'));
        $this->assertTrue($this->isValidUrl('https://google.com'));
        $this->assertFalse($this->isValidUrl('google.com'));
    }

    /**
     * @return void
     */
    public function testShouldEqualsWhenParseBaseUrl(): void
    {
        $this->assertEquals('http://google.com', $this->parseBaseUrl('http://google.com'));
        $this->assertEquals('https://google.com', $this->parseBaseUrl('https://google.com'));
        $this->assertEquals('google.com', $this->parseBaseUrl('google.com'));
    }
}
