<?php

namespace Ordinary9843\Traits;

trait MasterTrait
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
        if (!isset($parseUrl['scheme']) || !isset($parseUrl['host'])) {
            return $url;
        }

        return $parseUrl['scheme'] . '://' . $parseUrl['host'];
    }
}
