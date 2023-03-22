<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Ordinary9843\Constants\MasterConstant;
use Ordinary9843\Master;
use GuzzleHttp\Client;

class MasterTest extends TestCase
{
    /** @var Master */
    private $master = null;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @var Master */
        $this->master = new Master();
    }

    /**
     * @return void
     */
    public function testClient(): void
    {
        $this->assertInstanceOf(Client::class, $this->master->getClient());
    }

    /**
     * @return void
     */
    public function testConnectionTimeout(): void
    {
        $connectionTimeout = 10;
        $this->master->setConnectTimeout($connectionTimeout);
        $this->assertEquals($connectionTimeout, $this->master->getConnectTimeout());
    }

    /**
     * @return void
     */
    public function testTimeout(): void
    {
        $timeout = 10;
        $this->master->setTimeout($timeout);
        $this->assertEquals($timeout, $this->master->getTimeout());
    }

    /**
     * @return void
     */
    public function testError(): void
    {
        $this->assertEmpty($this->master->getError());

        $error = 'test-error';
        $this->master->setError($error);
        $this->assertEquals($error, $this->master->getError());
    }

    /**
     * @return void
     */
    public function testUserAgent(): void
    {
        $this->assertContains($this->master->getUserAgent(), MasterConstant::USER_AGENTS);
    }
}
