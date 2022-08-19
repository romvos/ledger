<?php

use yii\db\Migration;

/**
 * Class m220323_192604_add_checkout
 */
class m220323_192604_add_checkout extends Migration
{
    public $tableName = 'checkout';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'shop_id' => $this->integer()->notNull(),
            'date_pay' => $this->integer(),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer(),
            'comment' => $this->text(),
        ]);

        $this->addForeignKey(
            'fk_checkout_shop_id',
            $this->tableName,
            'shop_id',
            'shop',
            'id',
            'cascade',
            'cascade'
        );
        $this->createIndex('idx_checkout_shop_id', $this->tableName, 'shop_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_checkout_shop_id', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
