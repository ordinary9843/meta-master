<?php

namespace Ordinary9843;

use Ordinary9843\Constants\MetaConstant;

class Meta
{
    /** @var array */
    private $meta = [
        MetaConstant::TITLE => '',
        MetaConstant::CHARSET => '',
        MetaConstant::KEYWORDS => '',
        MetaConstant::DESCRIPTION => '',
        MetaConstant::VIEWPORT => '',
        MetaConstant::AUTHOR => '',
        MetaConstant::COPYRIGHT => '',
        MetaConstant::ROBOTS => '',
        MetaConstant::OG => [],
        MetaConstant::TWITTER => []
    ];

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->meta;
    }

    /**
     * @param string $title
     * 
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->meta[MetaConstant::TITLE] = $title;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->meta[MetaConstant::TITLE];
    }

    /**
     * @param string $charset
     * 
     * @return void
     */
    public function setCharset(string $charset): void
    {
        $this->meta[MetaConstant::CHARSET] = $charset;
    }

    /**
     * @return string
     */
    public function getCharset(): string
    {
        return $this->meta[MetaConstant::CHARSET];
    }

    /**
     * @param string $keywords
     * 
     * @return void
     */
    public function setKeywords(string $keywords): void
    {
        $this->meta[MetaConstant::KEYWORDS] = $keywords;
    }

    /**
     * @return string
     */
    public function getKeywords(): string
    {
        return $this->meta[MetaConstant::KEYWORDS];
    }

    /**
     * @param string $description
     * 
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->meta[MetaConstant::DESCRIPTION] = $description;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->meta[MetaConstant::DESCRIPTION];
    }

    /**
     * @param string $viewport
     * 
     * @return void
     */
    public function setViewport(string $viewport): void
    {
        $this->meta[MetaConstant::VIEWPORT] = $viewport;
    }

    /**
     * @return string
     */
    public function getViewport(): string
    {
        return $this->meta[MetaConstant::VIEWPORT];
    }

    /**
     * @param string $author
     * 
     * @return void
     */
    public function setAuthor(string $author): void
    {
        $this->meta[MetaConstant::AUTHOR] = $author;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->meta[MetaConstant::AUTHOR];
    }

    /**
     * @param string $copyright
     * 
     * @return void
     */
    public function setCopyright(string $copyright): void
    {
        $this->meta[MetaConstant::COPYRIGHT] = $copyright;
    }

    /**
     * @return string
     */
    public function getCopyright(): string
    {
        return $this->meta[MetaConstant::COPYRIGHT];
    }

    /**
     * @param string $robots
     * 
     * @return void
     */
    public function setRobots(string $robots): void
    {
        $this->meta[MetaConstant::ROBOTS] = $robots;
    }

    /**
     * @return string
     */
    public function getRobots(): string
    {
        return $this->meta[MetaConstant::ROBOTS];
    }

    /**
     * @param string $name
     * @param string $content
     * 
     * @return void
     */
    public function setOg(string $name, string $content): void
    {
        $this->meta[MetaConstant::OG][$name] = $content;
    }

    /**
     * @return array
     */
    public function getOg(): array
    {
        return $this->meta[MetaConstant::OG];
    }

    /**
     * @param string $name
     * @param string $content
     * 
     * @return void
     */
    public function setTwitter(string $name, string $content): void
    {
        $this->meta[MetaConstant::TWITTER][$name] = $content;
    }

    /**
     * @return array
     */
    public function getTwitter(): array
    {
        return $this->meta[MetaConstant::TWITTER];
    }

    /**
     * @param array $tags
     * 
     * @return void
     */
    public function setMeta(array $tags): void
    {
        foreach ($tags as $name => $content) {
            switch ($name) {
                case MetaConstant::KEYWORDS:
                    $this->setKeywords($content);
                    break;
                case MetaConstant::DESCRIPTION:
                    $this->setDescription($content);
                    break;
                case MetaConstant::VIEWPORT:
                    $this->setViewport($content);
                    break;
                case MetaConstant::AUTHOR:
                    $this->setAuthor($content);
                    break;
                case MetaConstant::COPYRIGHT:
                    $this->setCopyright($content);
                    break;
                case MetaConstant::ROBOTS:
                    $this->setRobots($content);
                    break;
                case substr($name, 0, 3) === 'og:':
                    $this->setOg($name, $content);
                    break;
                case substr($name, 0, 8) === 'twitter:':
                    $this->setTwitter($name, $content);
                    break;
            }
        }
    }
}
