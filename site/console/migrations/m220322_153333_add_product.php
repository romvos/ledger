<?php

use yii\db\Migration;

/**
 * Class m220322_153333_add_product
 */
class m220322_153333_add_product extends Migration
{
    public $tableName = 'product';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'weightNet' => $this->integer()->comment('вес Нетто'),
            'weightGross' => $this->integer()->comment('вес Брутто'),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer(),
            'measureSuffix' => $this->string(10)->notNull()->comment('суффикс единиц измерения'),
            'title' => $this->string(300)->notNull()->comment('название товара'),
            'description' => $this->text(),
            'comment' => $this->text(),
        ]);

        $this->createIndex('idx_product_title', $this->tableName, 'title', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
