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
use Mindy\Orm\Fields\ForeignField;
use Mindy\Orm\Model;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Video
 *
 * @property string $name
 * @property string $source
 * @property int $category_id
 * @property Category $category
 */
class Video extends Model
{
    public static function getFields()
    {
        return [
            'name' => [
                'class' => CharField::class,
            ],
            'source' => [
                'class' => CharField::class,
                'validators' => [
                    new Assert\Url(),
                ],
            ],
            'category' => [
                'class' => ForeignField::class,
                'modelClass' => Category::class,
            ],
        ];
    }

    public function __toString()
    {
        return (string) $this->name;
    }
}
