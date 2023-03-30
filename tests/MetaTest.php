<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Ordinary9843\Meta;
use Ordinary9843\Constants\MetaConstant;

class MetaTest extends TestCase
{
    /** @var Meta */
    private $meta = null;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @var Meta */
        $this->meta = new Meta();
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $meta = $this->meta->get();
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
    public function testTitle(): void
    {
        $title = 'test-title';
        $this->meta->setTitle($title);
        $this->assertEquals($title, $this->meta->getTitle());
    }

    /**
     * @return void
     */
    public function testCharset(): void
    {
        $charset = 'test-charset';
        $this->meta->setCharset($charset);
        $this->assertEquals($charset, $this->meta->getCharset());
    }

    /**
     * @return void
     */
    public function testKeywords(): void
    {
        $keywords = 'test-keyword-a, test-keyword-b, test-keyword-c';
        $this->meta->setKeywords($keywords);
        $this->assertEquals($keywords, $this->meta->getKeywords());
    }

    /**
     * @return void
     */
    public function testDescription(): void
    {
        $description = 'test-description';
        $this->meta->setDescription($description);
        $this->assertEquals($description, $this->meta->getDescription());
    }

    /**
     * @return void
     */
    public function testViewport(): void
    {
        $viewport = 'test-viewport';
        $this->meta->setViewport($viewport);
        $this->assertEquals($viewport, $this->meta->getViewport());
    }

    /**
     * @return void
     */
    public function testAuthor(): void
    {
        $author = 'test-author';
        $this->meta->setAuthor($author);
        $this->assertEquals($author, $this->meta->getAuthor());
    }

    /**
     * @return void
     */
    public function testCopyright(): void
    {
        $copyright = 'test-copyright';
        $this->meta->setCopyright($copyright);
        $this->assertEquals($copyright, $this->meta->getCopyright());
    }

    /**
     * @return void
     */
    public function testRobots(): void
    {
        $robots = 'test-robots';
        $this->meta->setRobots($robots);
        $this->assertEquals($robots, $this->meta->getRobots());
    }

    /**
     * @return void
     */
    public function testOg(): void
    {
        $this->meta->setOg('og:title', 'test-facebook-title');
        $this->assertEquals([
            'og:title' => 'test-facebook-title',
        ], $this->meta->getOg());
    }

    /**
     * @return void
     */
    public function testTwitter(): void
    {
        $this->meta->setTwitter('twitter:card', 'summary');
        $this->assertEquals([
            'twitter:card' => 'summary',
        ], $this->meta->getTwitter());
    }

    /**
     * @return void
     */
    public function testMeta(): void
    {
        $keywords = 'test-keyword-a, test-keyword-b, test-keyword-c';
        $description = 'test-description';
        $viewport = 'test-viewport';
        $author = 'test-author';
        $copyright = 'test-copyright';
        $robots = 'test-robots';
        $this->meta->setMeta([
            MetaConstant::KEYWORDS => $keywords,
            MetaConstant::DESCRIPTION => $description,
            MetaConstant::VIEWPORT => $viewport,
            MetaConstant::AUTHOR => $author,
            MetaConstant::COPYRIGHT => $copyright,
            MetaConstant::ROBOTS => $robots,
            'og:title' => 'test-facebook-title',
            'twitter:card' => 'test-summary'
        ]);
        $this->assertEquals($keywords, $this->meta->getKeywords());
        $this->assertEquals($description, $this->meta->getDescription());
        $this->assertEquals($viewport, $this->meta->getViewport());
        $this->assertEquals($author, $this->meta->getAuthor());
        $this->assertEquals($copyright, $this->meta->getCopyright());
        $this->assertEquals($robots, $this->meta->getRobots());
        $this->assertEquals([
            'og:title' => 'test-facebook-title',
        ], $this->meta->getOg());
        $this->assertEquals([
            'twitter:card' => 'test-summary',
        ], $this->meta->getTwitter());
    }
}
