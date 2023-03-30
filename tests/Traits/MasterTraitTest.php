<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Ordinary9843\Traits\MasterTrait;

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
    public function testHasScheme(): void
    {
        $this->assertTrue($this->hasScheme('http://google.com'));
        $this->assertTrue($this->hasScheme('https://google.com'));
        $this->assertFalse($this->hasScheme('google.com'));
    }

    /**
     * @return void
     */
    public function testIsValidUrl(): void
    {
        $this->assertTrue($this->isValidUrl('http://google.com'));
        $this->assertTrue($this->isValidUrl('https://google.com'));
        $this->assertFalse($this->isValidUrl('google.com'));
    }
}
