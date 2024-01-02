<?php

namespace Ordinary9843;

use Ordinary9843\Constants\MasterConstant;
use Ordinary9843\Traits\MasterTrait;
use GuzzleHttp\Exception\ConnectException;
use Exception;

class MetaMaster extends Master
{
    use MasterTrait;

    /**
     * @param string $html
     * 
     * @return string
     */
    private function parseTitleFromTag(string $html): string
    {
        preg_match('/<title[^>]*>(.*?)<\/title>/', $html, $matches);

        return $matches[1] ?? '';
    }

    /**
     * @param string $html
     * 
     * @return string
     */
    private function parseCharsetFromTag(string $html): string
    {
        preg_match('/<meta[^>]+charset=["\']?([a-zA-Z0-9-]+)["\']?[^>]*>/', $html, $matches);

        return $matches[1] ?? '';
    }

    /**
     * @param string $html
     * 
     * @return array
     */
    private function parseMetaFromTag(string $html): array
    {
        preg_match_all('/<meta\s[^>]*>/i', $html, $matches);
        $meta = array_reduce($matches[0] ?? [], function ($result, $tag) {
            preg_match('/<meta\s+name="([^"]+)"\s+content="([^"]+)"\s*\/?>/i', $tag, $matches);
            $name = $matches[1] ?? '';
            $content = $matches[2] ?? '';
            ($name && $content) && $result[$name] = $content;

            return $result;
        }, []);

        return $meta;
    }

    /**
     * @param string $html
     * 
     * @return array
     */
    public function parseHtml(string $html): array
    {
        $meta = new Meta();
        if (!empty($html)) {
            $meta->setTitle($this->parseTitleFromTag($html));
            $meta->setCharset($this->parseCharsetFromTag($html));
            $meta->setMeta($this->parseMetaFromTag($html));
        }

        return $meta->get();
    }

    /**
     * @param string $url
     * 
     * @return array
     */
    public function parse(string $url): array
    {
        $html = '';

        try {
            if (!$this->isValidUrl($url)) {
                throw new Exception($url . ' is not a valid URL.');
            }

            $html = $this->getClient()->get($url, [
                'headers' => [
                    'User-Agent' => $this->getUserAgent()
                ]
            ])->getBody()->getContents();
        } catch (ConnectException | Exception $e) {
            $this->addMessage(MasterConstant::MESSAGE_TYPE_ERROR, $e->getMessage());
        }

        return $this->parseHtml($html);
    }
}
