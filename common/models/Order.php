<?php

namespace common\models;

use common\models\query\OrderQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $user_id
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $comment
 * @property integer $status
 *
 * @property User $user
 * @property OrderItem[] $orderItems
 */
class Order extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'user_id', 'email', 'phone', 'address', 'comment', 'status'], 'required'],
            [['created_at', 'user_id', 'status'], 'integer'],
            [['address', 'comment'], 'string'],
            [['email', 'phone'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'user_id' => 'User ID',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'comment' => 'Comment',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }
}
