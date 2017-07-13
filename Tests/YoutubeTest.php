<?php

/*
 * This file is part of Mindy Framework.
 * (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\VideoBundle\Tests;

use Mindy\Bundle\VideoBundle\VideoProvider\YoutubeVideoProvider;

class YoutubeTest extends \PHPUnit_Framework_TestCase
{
    public function urlValidProvider()
    {
        return [
            ['https://www.youtube.com/watch?v=vidid', true],
            ['//youtube.com/v/vidid', true],
            ['//youtube.com/vi/vidid?autoplay=1', true],
            ['//youtube.com/?v=vidid', true],
            ['//youtube.com/?vi=vidid', true],
            ['//youtube.com/watch?v=vidid', true],
            ['//youtube.com/watch?vi=vidid', true],
            ['//youtu.be/vidid', true],
            ['//youtube.com/embed/vidid', true],
            ['http://youtube.com/v/vidid', true],
            ['http://www.youtube.com/v/vidid', true],
            ['https://www.youtube.com/v/vidid', true],
            ['//youtube.com/watch?v=vidid&wtv=wtv', true],
            ['http://www.youtube.com/watch?dev=inprogress&v=vidid&feature=related', true],
            ['https://m.youtube.com/watch?v=vidid', true],
        ];
    }

    /**
     * @dataProvider urlValidProvider
     */
    public function testYoutubeSupport($url, $support)
    {
        $provider = new YoutubeVideoProvider();
        $this->assertSame($support, $provider->supports($url), sprintf('%s', $url));
    }

    /**
     * @dataProvider urlValidProvider
     */
    public function testYoutubeEmbed($url)
    {
        $provider = new YoutubeVideoProvider();
        $tpl = '<iframe width="560" height="315" src="https://www.youtube.com/embed/vidid" frameborder="0" allowfullscreen></iframe>';
        $this->assertSame($tpl, $provider->parse($url));
    }
}
