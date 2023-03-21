<?php

namespace Ordinary9843\Traits;

use Ordinary9843\Constants\MetaConstant;

trait MetaTrait
{
    /**
     * @param string $url
     * 
     * @return bool
     */
    public function hasScheme(string $url): bool
    {
        return (substr($url, 0, 7) === 'http://' || substr($url, 0, 8) === 'https://');
    }

    /**
     * @param string $url
     * 
     * @return bool
     */
    public function isValidUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    /**
     * @param string $url
     * 
     * @return string
     */
    public function parseBaseUrl(string $url): string
    {
        $parseUrl = parse_url($url);

        return $parseUrl['scheme'] . '://' . $parseUrl['host'];
    }

    /**
     * @param string $html
     * 
     * @return string
     */
    public function parseTitleFromTag(string $html): string
    {
        preg_match('/<title[^>]*>(.*?)<\/title>/', $html, $matches);

        return $matches[1] ?? '';
    }

    /**
     * @param string $html
     * 
     * @return string
     */
    public function parseCharsetFromTag(string $html): string
    {
        preg_match('/<meta[^>]+charset=["\']?([a-zA-Z0-9-]+)["\']?[^>]*>/', $html, $matches);

        return $matches[1] ?? '';
    }

    /**
     * @param string $html
     * 
     * @return array
     */
    public function parseMetaFromTag(string $html): array
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
    public function parseStaticSourcesFromTag(string $url, string $html): array
    {
        preg_match_all('/<(link|script|img)[^>]*>/i', $html, $matches);
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
                    } elseif ($rel === 'stylesheet') {
                        $result[MetaConstant::CSS][] = $href;
                    } else {
                        $result[MetaConstant::LINKS][$rel][] = $href;
                    }
                }
            } elseif (substr($tag, 0, 7) === '<script') {
                preg_match('/<script.*?src="(.*?)".*?>/is', $tag, $matches);
                $src = trim($matches[1] ?? '', '/');
                if ($src) {
                    (!$this->hasScheme($src)) && $src = $baseUrl . $src;
                    $result[MetaConstant::JS][] = $src;
                }
            } elseif (substr($tag, 0, 4) === '<img') {
                preg_match('/<img.*?src="(.*?)".*?>/i', $tag, $matches);
                $src = trim($matches[1] ?? '', '/');
                if ($src) {
                    (!$this->hasScheme($src)) && $src = $baseUrl . $src;
                    $result[MetaConstant::IMAGES][] = $src;
                }
            }

            return $result;
        }, [
            MetaConstant::LINKS => [],
            MetaConstant::CSS => [],
            MetaConstant::JS => [],
            MetaConstant::ICONS => [],
            MetaConstant::IMAGES => []
        ]);
        $staticSources[MetaConstant::LINKS] = array_map('array_values', array_map('array_unique', $staticSources[MetaConstant::LINKS]));
        $staticSources[MetaConstant::CSS] = array_values(array_unique($staticSources[MetaConstant::CSS]));
        $staticSources[MetaConstant::JS] = array_values(array_unique($staticSources[MetaConstant::JS]));
        $staticSources[MetaConstant::ICONS] = array_values(array_unique($staticSources[MetaConstant::ICONS]));
        $staticSources[MetaConstant::IMAGES] = array_values(array_unique($staticSources[MetaConstant::IMAGES]));

        return $staticSources;
    }
}
