<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Ordinary9843\Constants\MasterConstant;
use Ordinary9843\Master;

class MasterTest extends TestCase
{
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
    public function testShouldArrayHasKeyWhenGetMessages(): void
    {
        $master = new Master();
        $messages = $master->getMessages();
        $this->assertArrayHasKey(MasterConstant::MESSAGE_TYPE_INFO, $messages);
        $this->assertArrayHasKey(MasterConstant::MESSAGE_TYPE_ERROR, $messages);
    }

    /**
     * @return void
     */
    public function testShouldNotEmptyInfoMessageWhenGetMessages(): void
    {
        $master = new Master();
        $master->addMessage(MasterConstant::MESSAGE_TYPE_INFO, 'Message.');
        $this->assertNotEmpty($master->getMessages()[MasterConstant::MESSAGE_TYPE_INFO]);
    }

    /**
     * @return void
     */
    public function testShouldNotEmptyErrorMessageWhenGetMessages(): void
    {
        $master = new Master();
        $master->addMessage(MasterConstant::MESSAGE_TYPE_ERROR, 'Message.');
        $this->assertNotEmpty($master->getMessages()[MasterConstant::MESSAGE_TYPE_ERROR]);
    }
}
