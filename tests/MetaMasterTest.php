<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Ordinary9843\MetaMaster;
use Ordinary9843\Constants\MetaConstant;
use Ordinary9843\Constants\MasterConstant;

class MetaMasterTest extends TestCase
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
    public function testShouldArrayHasKeyParseHtml(): void
    {
        $metaMaster = new MetaMaster();
        $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>example</title></head><body><h1>example</h1></body></html>';
        $meta = $metaMaster->parseHtml($html);
        $this->assertCount(10, $meta);
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
    }

    /**
     * @return void
     */
    public function testShouldArrayHasKeyWhenParse(): void
    {
        $urls = [
            'https://github.com/ordinary9843',
            'https://www.google.com',
            'https://www.youtube.com',
            'https://www.facebook.com'
        ];
        foreach ($urls as $url) {
            $metaMaster = new MetaMaster();
            $meta = $metaMaster->parse($url);
            $this->assertCount(10, $meta);
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
        }
    }

    /**
     * @return void
     */
    public function testShouldNotEmptyMessagesWhenParse(): void
    {
        $metaMaster = new MetaMaster();
        $metaMaster->parse('google.com');
        $this->assertNotEmpty($metaMaster->getMessages()[MasterConstant::MESSAGE_TYPE_ERROR]);

        $metaMaster->parse('https://' . md5(uniqid()) . '.com');
        $this->assertNotEmpty($metaMaster->getMessages()[MasterConstant::MESSAGE_TYPE_ERROR]);
    }
}
