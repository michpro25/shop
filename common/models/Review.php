<?php

namespace common\models;

use common\models\query\ReviewQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%review}}".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $product_id
 * @property integer $user_id
 * @property integer $rating
 * @property string $content
 * @property integer $status
 *
 * @property Product $product
 * @property User $user
 */
class Review extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%review}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'product_id', 'status'], 'required'],
            [['created_at', 'product_id', 'user_id', 'rating', 'status'], 'integer'],
            [['content'], 'string'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
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
            'product_id' => 'Product ID',
            'user_id' => 'User ID',
            'rating' => 'Rating',
            'content' => 'Content',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return ReviewQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReviewQuery(get_called_class());
    }
}
