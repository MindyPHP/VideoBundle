<?php

/*
 * This file is part of Mindy Framework.
 * (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\VideoBundle\Library;

use Mindy\Bundle\VideoBundle\Model\Video;
use Mindy\Bundle\VideoBundle\VideoProvider\Factory;
use Mindy\Template\Library;

class VideoLibrary extends Library
{
    /**
     * @var Factory
     */
    protected $videoFactory;

    /**
     * VideoLibrary constructor.
     *
     * @param Factory $videoFactory
     */
    public function __construct(Factory $videoFactory)
    {
        $this->videoFactory = $videoFactory;
    }

    /**
     * @return array
     */
    public function getHelpers()
    {
        return [
            'get_videos' => function ($id, $limit = 5) {
                return Video::objects()
                    ->filter(['category_id' => $id])
                    ->limit($limit)
                    ->all();
            },
            'embed_video' => function ($url, $width = 560, $height = 315) {
                return $this->videoFactory->parse($url, $width, $height);
            },
            'embed_video_thumb' => function ($url) {
                return $this->videoFactory->parseThumb($url);
            },
            'embed_video_id' => function ($url) {
                return $this->videoFactory->parseId($url);
            },
        ];
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return [];
    }
}
