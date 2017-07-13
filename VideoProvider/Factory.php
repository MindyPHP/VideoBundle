<?php

/*
 * This file is part of Mindy Framework.
 * (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\VideoBundle\VideoProvider;

class Factory
{
    /**
     * @var VideoProviderInterface[]
     */
    protected $providers = [];

    /**
     * @param VideoProviderInterface $videoProvider
     */
    public function addVideoProvider(VideoProviderInterface $videoProvider)
    {
        $this->providers[] = $videoProvider;
    }

    /**
     * @param $url
     * @param int $width
     * @param int $height
     *
     * @return null|string
     */
    public function parse($url, $width = 560, $height = 315)
    {
        foreach ($this->providers as $provider) {
            if ($provider->supports($url)) {
                return $provider->parse($url, $width, $height);
            }
        }

        return null;
    }

    /**
     * @param $url
     *
     * @return null|string
     */
    public function parseId($url)
    {
        foreach ($this->providers as $provider) {
            if ($provider->supports($url)) {
                return $provider->parseId($url);
            }
        }

        return null;
    }

    /**
     * @param $url
     *
     * @throws VideoThumbNotSupportException
     *
     * @return null|string
     */
    public function parseThumb($url)
    {
        foreach ($this->providers as $provider) {
            if ($provider->supports($url)) {
                return $provider->getThumb($url);
            }
        }

        return null;
    }
}
