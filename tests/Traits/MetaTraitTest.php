<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Ordinary9843\Traits\MetaTrait;
use Ordinary9843\Constants\MetaConstant;

class MetaTraitTest extends TestCase
{
    use MetaTrait;

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

    /**
     * @return void
     */
    public function testParseBaseUrl(): void
    {
        $this->assertEquals('https://google.com', $this->parseBaseUrl('https://google.com/test'));
    }

    /**
     * @return void
     */
    public function testParseTitleFromTag(): void
    {
        $tags = [
            '<title>test-title</title>'
        ];
        $this->asserTequals('test-title', $this->parseTitleFromTag(implode(PHP_EOL, $tags)));
    }

    /**
     * @return void
     */
    public function testParseCharsetFromTag(): void
    {
        $tags = [
            '<meta charset="test-utf-8">'
        ];
        $this->asserTequals('test-utf-8', $this->parseCharsetFromTag(implode(PHP_EOL, $tags)));
    }

    /**
     * @return void
     */
    public function testParseMetaFromTag(): void
    {
        $tags = [
            '<meta name="viewport" content="test-viewport">',
            '<meta name="description" content="test-description">',
            '<meta name="keywords" content="test-keyword-a, test-keyword-b, test-keyword-c">',
            '<meta name="author" content="test-author">',
            '<meta name="copyright" content="test-copyright">',
            '<meta name="robots" content="test-robots">'
        ];
        $meta = $this->parseMetaFromTag(implode(PHP_EOL, $tags));
        $this->assertArrayHasKey(MetaConstant::KEYWORDS, $meta);
        $this->assertArrayHasKey(MetaConstant::DESCRIPTION, $meta);
        $this->assertArrayHasKey(MetaConstant::VIEWPORT, $meta);
        $this->assertArrayHasKey(MetaConstant::AUTHOR, $meta);
        $this->assertArrayHasKey(MetaConstant::COPYRIGHT, $meta);
        $this->assertArrayHasKey(MetaConstant::ROBOTS, $meta);
    }

    /**
     * @return void
     */
    public function testParseStaticResourcesFromTag(): void
    {
        $tags = [
            '<link rel="icon" href="https://test.com/test.icon" />',
            '<link rel="stylesheet" href="https://test.com/test.css" />',
            '<link rel="alternate" href="https://test.com/alternate" />',
            '<script src="https://test.com/test.js"></script>',
            '<img src="https://test.com/test.jpg" />'
        ];
        $staticResources = $this->parseStaticSourcesFromTag('https://test.com', implode(PHP_EOL, $tags));
        $this->assertArrayHasKey(MetaConstant::LINKS, $staticResources);
        $this->assertArrayHasKey(MetaConstant::CSS, $staticResources);
        $this->assertArrayHasKey(MetaConstant::JS, $staticResources);
        $this->assertArrayHasKey(MetaConstant::ICONS, $staticResources);
        $this->assertArrayHasKey(MetaConstant::IMAGES, $staticResources);
    }
}
