<?php

use yii\db\Migration;

/**
 * Class m220323_194532_add_checkout_item
 */
class m220323_194532_add_checkout_item extends Migration
{
    public $tableNameCheckoutItem = 'checkoutItem';
    public $tableNameCheckout = 'checkout';
    public $tableNameProduct = 'product';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableNameCheckoutItem, [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'checkout_id' => $this->integer()->notNull(),
            'priceUnit' => $this->money()->notNull(),
            'priceItem' => $this->money()->notNull(),
            'amountUnit' => $this->float()->notNull(),
            'discountPercent' => $this->integer(),
            'discountAbsolute' => $this->integer(),
        ]);

        $this->addForeignKey('fk_checkoutItem_product_id',
            $this->tableNameCheckoutItem,
            'product_id',
            $this->tableNameProduct,
            'id',
            'cascade',
            'cascade'
        );
        $this->addForeignKey('fk_checkoutItem_checkout_id',
            $this->tableNameCheckoutItem,
            'checkout_id',
            $this->tableNameCheckout,
            'id',
            'cascade',
            'cascade'
        );

        $this->createIndex('idx_checkoutItem_product_id', $this->tableNameCheckoutItem, 'product_id');
        $this->createIndex('idx_checkoutItem_checkout_id', $this->tableNameCheckoutItem, 'checkout_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_checkoutItem_product_id', $this->tableNameCheckoutItem);
        $this->dropForeignKey('fk_checkoutItem_checkout_id', $this->tableNameCheckoutItem);

        $this->dropTable($this->tableNameCheckoutItem);
    }
}
