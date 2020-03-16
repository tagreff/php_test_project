<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_order}}`.
 */
class m200316_191147_create_product_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_order}}', [
            'id' => $this->primaryKey(),
            'ordered_amount' => $this->integer(),
            'product_id' => $this->integer(),
            'order_id' => $this->integer()
        ]);
        
        $this->createIndex(
            'idx-product-id',
            '{{%product_order}}',
            'product_id'
        );
        
        $this->addForeignKey(
            'fk-product_order-product_id',
            'product_order',
            'product_id',
            'product',
            'id',
            'CASCADE');

        $this->createIndex(
            'idx-order-id',
            '{{%product_order}}',
            'order_id'
        );

        $this->addForeignKey(
            'fk-product_order-order_id',
            'product_order',
            'order_id',
            'order',
            'id',
            'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_order}}');
        $this->dropIndex('idx-product-id', 'product_order');
        $this->dropIndex('idx-order-id', 'product_order');
        $this->dropForeignKey('fk-product_order-product_id', 'product_order');
        $this->dropForeignKey('fk-product_order-order_id', 'product_order');
    }
}
