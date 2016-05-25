<?php

namespace common\models;

use common\models\query\ProductQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $price
 * @property string $price_old
 * @property integer $count
 * @property integer $status
 * @property string $seo_h1
 * @property string $seo_title
 * @property string $seo_content
 * @property integer $main_category_id
 * @property integer $main_photo_id
 *
 * @property Cart[] $carts
 * @property User[] $users
 * @property Compare[] $compares
 * @property User[] $users0
 * @property OrderItem[] $orderItems
 * @property Photo[] $photos
 * @property Category $mainCategory
 * @property Photo $mainPhoto
 * @property ProductCategory[] $productCategories
 * @property Category[] $categories
 * @property ProductTag[] $productTags
 * @property Tag[] $tags
 * @property Review[] $reviews
 */
class Product extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'price', 'count', 'status'], 'required'],
            [['price', 'price_old'], 'number'],
            [['count', 'status', 'main_category_id', 'main_photo_id'], 'integer'],
            [['seo_content'], 'string'],
            [['code', 'name', 'seo_h1', 'seo_title'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['main_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['main_category_id' => 'id']],
            [['main_photo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Photo::className(), 'targetAttribute' => ['main_photo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'price' => 'Price',
            'price_old' => 'Price Old',
            'count' => 'Count',
            'status' => 'Status',
            'seo_h1' => 'Seo H1',
            'seo_title' => 'Seo Title',
            'seo_content' => 'Seo Content',
            'main_category_id' => 'Main Category ID',
            'main_photo_id' => 'Main Photo ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('{{%cart}}', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompares()
    {
        return $this->hasMany(Compare::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers0()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('{{%compare}}', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'main_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainPhoto()
    {
        return $this->hasOne(Photo::className(), ['id' => 'main_photo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategories()
    {
        return $this->hasMany(ProductCategory::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('{{%product_category}}', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTags()
    {
        return $this->hasMany(ProductTag::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('{{%product_tag}}', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['product_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
