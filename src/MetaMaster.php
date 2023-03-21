<?php

namespace Ordinary9843;

use Ordinary9843\Traits\MetaTrait;
use GuzzleHttp\Exception\ConnectException;
use Exception;

class MetaMaster extends Master
{
    use MetaTrait;

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
            $this->setError($e->getMessage());
        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }

        return $meta->get();
    }
}
