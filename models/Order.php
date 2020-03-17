<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $name
 * @property string $number
 * @property int $status
 * @property string|null $customer_name
 *
 * @property ProductOrder[] $productOrders
 */
class Order extends \yii\db\ActiveRecord
{
    public $orderedAmount;
    public $product_ids;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'number', 'status'], 'required'],
            [['status'], 'integer'],
            ['product_ids', 'each', 'rule' => ['integer']],
            [['name', 'number', 'customer_name'], 'string', 'max' => 255],
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
            'number' => 'Number',
            'status' => 'Status',
            'customer_name' => 'Customer Name',
        ];
    }

    /**
     * Gets query for [[ProductOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductOrders()
    {
        return $this->hasMany(ProductOrder::class, ['order_id' => 'id']);
    }

    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])
            ->viaTable('product_order', ['order_id' => 'id']);
    }

    public function getList()
    {
       // if ($this->products)
         //   return ArrayHelper::map($this->products, 'id', 'name');
        //else {
            $models = Product::find()->select(['id', 'name'])->orderBy('name')->asArray()->all();
            return ArrayHelper::map($models, 'id', 'name');
       // }

    }
}
