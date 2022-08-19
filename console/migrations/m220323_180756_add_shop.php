<?php

use yii\db\Migration;

/**
 * Class m220323_180756_add_shop
 */
class m220323_180756_add_shop extends Migration
{
    public $tableNameShop = 'shop';
    public $tableNameCurrency = 'currency';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableNameShop, [
            'id' => $this->primaryKey(),
            'currency_id' => $this->integer()->comment('Валюта магазина'),
            'title' => $this->string(250)->notNull(),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer(),
            'description' => $this->text(),
        ]);

        $this->addForeignKey('fk_shop_currency_id',
            $this->tableNameShop,
            'currency_id',
            $this->tableNameCurrency,
            'id',
            'set null',
            'cascade'
        );

        $this->createIndex('idx_shop_currency_id', $this->tableNameShop, 'currency_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_shop_currency_id', $this->tableNameShop);
        $this->dropTable($this->tableNameShop);
    }
}
