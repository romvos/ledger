<?php

use yii\db\Migration;

/**
 * Class m220323_144235_add_currency
 */
class m220323_144235_add_currency extends Migration
{
    public $tableName = 'currency';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull()->comment('название валюты'),
            'suffix' => $this->string()->notNull()->comment('суффикс валюты'),
            'symbolClass' => $this->string()->comment('font awesome класс'),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
