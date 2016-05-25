<?php

namespace common\models;

use common\models\query\CategoryQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $id
 * @property integer $lft
 * @property integer $rgt
 * @property integer $lvl
 * @property string $name
 * @property string $slug
 * @property string $content
 * @property integer $status
 * @property string $seo_h1
 * @property string $seo_title
 * @property string $seo_content
 *
 * @property Product[] $products
 * @property ProductCategory[] $productCategories
 * @property Product[] $products0
 */
class Category extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lft', 'rgt', 'lvl', 'name', 'slug', 'content', 'status'], 'required'],
            [['lft', 'rgt', 'lvl', 'status'], 'integer'],
            [['content', 'seo_content'], 'string'],
            [['name', 'slug', 'seo_h1', 'seo_title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'lvl' => 'Lvl',
            'name' => 'Name',
            'slug' => 'Slug',
            'content' => 'Content',
            'status' => 'Status',
            'seo_h1' => 'Seo H1',
            'seo_title' => 'Seo Title',
            'seo_content' => 'Seo Content',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['main_category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategories()
    {
        return $this->hasMany(ProductCategory::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts0()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('{{%product_category}}', ['category_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }
}
