<?php

/*
 * This file is part of Mindy Framework.
 * (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\VideoBundle\Admin;

use Mindy\Bundle\AdminBundle\Admin\AbstractModelAdmin;
use Mindy\Bundle\VideoBundle\Form\Admin\VideoForm;
use Mindy\Bundle\VideoBundle\Model\Video;

class VideoAdmin extends AbstractModelAdmin
{
    public $columns = ['name', 'source'];

    public function getFormType()
    {
        return VideoForm::class;
    }

    public function getModelClass()
    {
        return Video::class;
    }
}
