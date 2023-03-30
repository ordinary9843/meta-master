<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Ordinary9843\MetaMaster;
use Ordinary9843\Constants\MetaConstant;

class MetaMasterTest extends TestCase
{
    /** @var MetaMaster */
    private $metaMaster = null;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @var MetaMaster */
        $this->metaMaster = new MetaMaster();
    }

    /**
     * @return void
     */
    public function testParse(): void
    {
        $urls = [
            'https://github.com/ordinary9843/meta-master',
            'https://www.google.com',
            'https://www.youtube.com',
            'https://www.facebook.com'
        ];
        foreach ($urls as $url) {
            $meta = $this->metaMaster->parse($url);
            $this->assertCount(11, $meta);
            $this->assertArrayHasKey(MetaConstant::TITLE, $meta);
            $this->assertArrayHasKey(MetaConstant::CHARSET, $meta);
            $this->assertArrayHasKey(MetaConstant::KEYWORDS, $meta);
            $this->assertArrayHasKey(MetaConstant::DESCRIPTION, $meta);
            $this->assertArrayHasKey(MetaConstant::VIEWPORT, $meta);
            $this->assertArrayHasKey(MetaConstant::AUTHOR, $meta);
            $this->assertArrayHasKey(MetaConstant::COPYRIGHT, $meta);
            $this->assertArrayHasKey(MetaConstant::ROBOTS, $meta);
            $this->assertArrayHasKey(MetaConstant::OG, $meta);
            $this->assertArrayHasKey(MetaConstant::TWITTER, $meta);
            $this->assertArrayHasKey(MetaConstant::ICONS, $meta);
        }

        $this->metaMaster->parse('google.com');
        $this->assertNotEmpty($this->metaMaster->getError());

        $this->metaMaster->parse('https://' . md5(uniqid()) . '.com');
        $this->assertNotEmpty($this->metaMaster->getError());
    }
}
