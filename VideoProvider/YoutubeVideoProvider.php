<?php

/*
 * This file is part of Mindy Framework.
 * (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\VideoBundle\VideoProvider;

class YoutubeVideoProvider implements VideoProviderInterface
{
    public function getEmbedUrl($url)
    {
        $id = $this->parseId($url);
        if (null === $id) {
            throw new VideoParseException();
        }

        return sprintf('https://www.youtube.com/embed/%s', $id);
    }

    /**
     * {@inheritdoc}
     */
    public function parse($url, $width = 560, $height = 315)
    {
        $embedUrl = $this->getEmbedUrl($url);
        if (null === $embedUrl) {
            throw new VideoParseException();
        }

        return sprintf(
            '<iframe width="%s" height="%s" src="%s" frameborder="0" allowfullscreen></iframe>',
            $width,
            $height,
            $embedUrl);
    }

    /**
     * {@inheritdoc}
     */
    public function supports($url)
    {
        try {
            return $this->getEmbedUrl($url) !== null;
        } catch (VideoParseException $e) {
            return false;
        }
    }

    /**
     * @param $url
     *
     * @throws VideoParseException
     *
     * @return null|string
     */
    public function parseId($url)
    {
        $parsedUrl = parse_url($url);
        if ($parsedUrl === false || !isset($parsedUrl['host'])) {
            return null;
        }

        if (!empty($parsedUrl['query'])) {
            $query = [];
            parse_str($parsedUrl['query'], $query);
            foreach (['v', 'vi'] as $key) {
                if (!empty($query[$key])) {
                    return $query[$key];
                }
            }
        }

        if (($pos = strpos($parsedUrl['path'], '/v/')) !== false) {
            return substr($parsedUrl['path'], $pos + 3);
        } elseif (($pos = strpos($parsedUrl['path'], '/vi/')) !== false) {
            return substr($parsedUrl['path'], $pos + 4);
        } elseif (($pos = strpos($parsedUrl['path'], '/embed/')) !== false) {
            return substr($parsedUrl['path'], $pos + 7);
        }

        $id = trim($parsedUrl['path'], '/');

        return empty($id) ? null : $id;
    }

    /**
     * {@inheritdoc}
     */
    public function getThumb($url)
    {
        $id = $this->parseId($url);
        if (null === $id) {
            throw new VideoParseException();
        }

        return sprintf('http://img.youtube.com/vi/%s/0.jpg', $id);
    }
}
