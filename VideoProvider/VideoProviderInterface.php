<?php

/*
 * This file is part of Mindy Framework.
 * (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\VideoBundle\VideoProvider;

interface VideoProviderInterface
{
    /**
     * @param string $url
     *
     * @throws VideoThumbNotSupportException
     *
     * @return string
     */
    public function getThumb($url);

    /**
     * @param string $url
     *
     * @throws VideoParseException
     *
     * @return null|string
     */
    public function parseId($url);

    /**
     * @param string $url
     * @param int    $width
     * @param int    $height
     *
     * @throws VideoParseException
     *
     * @return string
     */
    public function parse($url, $width = 560, $height = 315);

    /**
     * @param string $url
     *
     * @return bool
     */
    public function supports($url);
}
