<?php

namespace Ordinary9843;

use Ordinary9843\Constants\MetaConstant;
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
     * @param string $url
     * @param string $html
     * 
     * @return array
     */
    private function parseStaticSourcesFromTag(string $url, string $html): array
    {
        preg_match_all('/<(link)[^>]*>/i', $html, $matches);
        $baseUrl = $this->parseBaseUrl($url);
        $staticSources = array_reduce($matches[0] ?? [], function ($result, $tag) use ($baseUrl) {
            if (substr($tag, 0, 5) === '<link') {
                preg_match('/<link.*?rel="(.*?)".*?href="(.*?)".*?>/is', $tag, $matches);
                $rel = $matches[1] ?? '';
                $href = trim($matches[2] ?? '', '/');
                if ($rel && $href) {
                    (!$this->hasScheme($href)) && $href = $baseUrl . $href;
                    if (strpos($rel, 'icon') !== false || in_array($rel, ['shortcut'])) {
                        $result[MetaConstant::ICONS][] = $href;
                    }
                }
            }

            return $result;
        }, [
            MetaConstant::ICONS => []
        ]);
        $staticSources[MetaConstant::ICONS] = array_values(array_unique($staticSources[MetaConstant::ICONS]));

        return $staticSources;
    }

    /**
     * @param string $url
     * 
     * @return array
     */
    public function parse(string $url): array
    {
        $meta = new Meta();

        try {
            if (!$this->isValidUrl($url)) {
                throw new Exception($url . ' is not a valid URL.');
            }

            $contents = $this->getClient()->get($url, [
                'headers' => [
                    'User-Agent' => $this->getUserAgent()
                ]
            ])->getBody()->getContents();
            if (!empty($contents)) {
                $meta->setTitle($this->parseTitleFromTag($contents));
                $meta->setCharset($this->parseCharsetFromTag($contents));
                $meta->setMeta($this->parseMetaFromTag($contents));
                $meta->setStaticSources($this->parseStaticSourcesFromTag($url, $contents));
            }
        } catch (ConnectException $e) {
            $this->setError('[ERROR] ' . $e->getMessage());
        } catch (Exception $e) {
            $this->setError('[ERROR] ' . $e->getMessage());
        }

        return $meta->get();
    }
}
