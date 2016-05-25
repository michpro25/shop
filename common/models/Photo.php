<?php

namespace common\models;

use common\models\query\PhotoQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%photo}}".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $name
 * @property string $file
 * @property integer $sort
 *
 * @property Product $product
 * @property Product[] $products
 */
class Photo extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%photo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'sort'], 'required'],
            [['product_id', 'sort'], 'integer'],
            [['name', 'file'], 'string', 'max' => 255],
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
            'product_id' => 'Product ID',
            'name' => 'Name',
            'file' => 'File',
            'sort' => 'Sort',
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
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['main_photo_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return PhotoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PhotoQuery(get_called_class());
    }
}
