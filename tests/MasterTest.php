<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

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
    public function testError(): void
    {
        $this->assertEmpty($this->master->getError());

        $error = 'test-error';
        $this->master->setError($error);
        $this->assertEquals([
            $error
        ], $this->master->getError());
    }
}
