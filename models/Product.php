<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string|null $amount
 * @property string|null $manufacturer
 *
 * @property ProductOrder[] $productOrders
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'amount', 'manufacturer'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'amount' => 'Amount',
            'manufacturer' => 'Manufacturer',
        ];
    }

    /**
     * Gets query for [[ProductOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductOrders()
    {
        return $this->hasMany(ProductOrder::class, ['product_id' => 'id']);
    }

    public function getOrders() {
        return $this->hasMany(Order::class, ['id' => 'order_id'])
            ->viaTable('product_order', ['product_id' => 'id']);
    }
}
