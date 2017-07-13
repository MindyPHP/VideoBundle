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
use Mindy\Bundle\VideoBundle\Form\Admin\CategoryForm;
use Mindy\Bundle\VideoBundle\Model\Category;

class CategoryAdmin extends AbstractModelAdmin
{
    public $columns = ['name'];

    public function getFormType()
    {
        return CategoryForm::class;
    }

    public function getModelClass()
    {
        return Category::class;
    }
}
