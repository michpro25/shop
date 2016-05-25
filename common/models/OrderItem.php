<?php

namespace common\models;

use common\models\query\OrderItemQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%order_item}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property string $code
 * @property string $name
 * @property string $price
 * @property integer $count
 *
 * @property Order $order
 * @property Product $product
 */
class OrderItem extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'code', 'name', 'price', 'count'], 'required'],
            [['order_id', 'product_id', 'count'], 'integer'],
            [['price'], 'number'],
            [['code', 'name'], 'string', 'max' => 255],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'code' => 'Code',
            'name' => 'Name',
            'price' => 'Price',
            'count' => 'Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @inheritdoc
     * @return OrderItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderItemQuery(get_called_class());
    }
}
