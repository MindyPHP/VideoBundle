<?php

/*
 * This file is part of Mindy Framework.
 * (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\VideoBundle\Model;

use Mindy\Orm\Fields\CharField;
use Mindy\Orm\Fields\SlugField;
use Mindy\Orm\Model;

/**
 * Class Category
 *
 * @property string $name
 * @property string $slug
 */
class Category extends Model
{
    public static function getFields()
    {
        return [
            'name' => [
                'class' => CharField::class,
            ],
            'slug' => [
                'class' => SlugField::class,
            ],
        ];
    }

    public function __toString()
    {
        return (string) $this->name;
    }
}
