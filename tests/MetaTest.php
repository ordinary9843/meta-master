<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Ordinary9843\Meta;
use Ordinary9843\Constants\MetaConstant;

class MetaTest extends TestCase
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
    public function testShouldArrayHasKeyWhenGet(): void
    {
        $meta = new Meta();
        $metadata = $meta->get();
        $this->assertCount(10, $metadata);
        $this->assertArrayHasKey(MetaConstant::TITLE, $metadata);
        $this->assertArrayHasKey(MetaConstant::CHARSET, $metadata);
        $this->assertArrayHasKey(MetaConstant::KEYWORDS, $metadata);
        $this->assertArrayHasKey(MetaConstant::DESCRIPTION, $metadata);
        $this->assertArrayHasKey(MetaConstant::VIEWPORT, $metadata);
        $this->assertArrayHasKey(MetaConstant::AUTHOR, $metadata);
        $this->assertArrayHasKey(MetaConstant::COPYRIGHT, $metadata);
        $this->assertArrayHasKey(MetaConstant::ROBOTS, $metadata);
        $this->assertArrayHasKey(MetaConstant::OG, $metadata);
        $this->assertArrayHasKey(MetaConstant::TWITTER, $metadata);
    }

    /**
     * @return void
     */
    public function testShouldArrayHasKeyWhenGetTitle(): void
    {
        $meta = new Meta();
        $title = 'title';
        $meta->setTitle($title);
        $this->assertEquals($title, $meta->getTitle());
    }

    /**
     * @return void
     */
    public function testShouldArrayHasKeyWhenGetCharset(): void
    {
        $meta = new Meta();
        $charset = 'charset';
        $meta->setCharset($charset);
        $this->assertEquals($charset, $meta->getCharset());
    }

    /**
     * @return void
     */
    public function testShouldArrayHasKeyWhenGetKeywords(): void
    {
        $meta = new Meta();
        $keywords = 'keyword-a, keyword-b, keyword-c';
        $meta->setKeywords($keywords);
        $this->assertEquals($keywords, $meta->getKeywords());
    }

    /**
     * @return void
     */
    public function testShouldArrayHasKeyWhenGetDescription(): void
    {
        $meta = new Meta();
        $description = 'description';
        $meta->setDescription($description);
        $this->assertEquals($description, $meta->getDescription());
    }

    /**
     * @return void
     */
    public function testShouldArrayHasKeyWhenGetViewport(): void
    {
        $meta = new Meta();
        $viewport = 'viewport';
        $meta->setViewport($viewport);
        $this->assertEquals($viewport, $meta->getViewport());
    }

    /**
     * @return void
     */
    public function testShouldArrayHasKeyWhenGetAuthor(): void
    {
        $meta = new Meta();
        $author = 'author';
        $meta->setAuthor($author);
        $this->assertEquals($author, $meta->getAuthor());
    }

    /**
     * @return void
     */
    public function testShouldArrayHasKeyWhenGetCopyright(): void
    {
        $meta = new Meta();
        $copyright = 'copyright';
        $meta->setCopyright($copyright);
        $this->assertEquals($copyright, $meta->getCopyright());
    }

    /**
     * @return void
     */
    public function testShouldArrayHasKeyWhenGetRobots(): void
    {
        $meta = new Meta();
        $robots = 'robots';
        $meta->setRobots($robots);
        $this->assertEquals($robots, $meta->getRobots());
    }

    /**
     * @return void
     */
    public function testShouldArrayHasKeyWhenGetOg(): void
    {
        $meta = new Meta();
        $meta->setOg('og:title', 'facebook-title');
        $this->assertEquals([
            'og:title' => 'facebook-title',
        ], $meta->getOg());
    }

    /**
     * @return void
     */
    public function testShouldArrayHasKeyWhenGetTwitter(): void
    {
        $meta = new Meta();
        $meta->setTwitter('twitter:card', 'summary');
        $this->assertEquals([
            'twitter:card' => 'summary',
        ], $meta->getTwitter());
    }

    /**
     * @return void
     */
    public function testShouldArrayHasKeyWhenGetMeta(): void
    {
        $meta = new Meta();
        $keywords = 'keyword-a, keyword-b, keyword-c';
        $description = 'description';
        $viewport = 'viewport';
        $author = 'author';
        $copyright = 'copyright';
        $robots = 'robots';
        $meta->setMeta([
            MetaConstant::KEYWORDS => $keywords,
            MetaConstant::DESCRIPTION => $description,
            MetaConstant::VIEWPORT => $viewport,
            MetaConstant::AUTHOR => $author,
            MetaConstant::COPYRIGHT => $copyright,
            MetaConstant::ROBOTS => $robots,
            'og:title' => 'facebook-title',
            'twitter:card' => 'summary'
        ]);
        $this->assertEquals($keywords, $meta->getKeywords());
        $this->assertEquals($description, $meta->getDescription());
        $this->assertEquals($viewport, $meta->getViewport());
        $this->assertEquals($author, $meta->getAuthor());
        $this->assertEquals($copyright, $meta->getCopyright());
        $this->assertEquals($robots, $meta->getRobots());
        $this->assertEquals([
            'og:title' => 'facebook-title',
        ], $meta->getOg());
        $this->assertEquals([
            'twitter:card' => 'summary',
        ], $meta->getTwitter());
    }
}
