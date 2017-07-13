<?php

/*
 * This file is part of Mindy Framework.
 * (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\VideoBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Mindy\Bundle\VideoBundle\Model\Category;
use Mindy\Bundle\VideoBundle\Model\Video;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170316083656 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $videoTable = $schema->createTable(Video::tableName());
        $videoTable->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement' => true]);
        $videoTable->addColumn('name', 'string', ['length' => 255]);
        $videoTable->addColumn('source', 'string', ['length' => 255]);
        $videoTable->addColumn('category_id', 'integer', ['length' => 11]);
        $videoTable->setPrimaryKey(['id']);

        $categoryTable = $schema->createTable(Category::tableName());
        $categoryTable->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement' => true]);
        $categoryTable->addColumn('name', 'string', ['length' => 255]);
        $categoryTable->addColumn('slug', 'string', ['length' => 255]);
        $categoryTable->setPrimaryKey(['id']);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $schema->dropTable(Video::tableName());
        $schema->dropTable(Category::tableName());
    }
}
