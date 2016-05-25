<?php

namespace common\models;

use common\models\query\ArticleQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property integer $id
 * @property integer $page_id
 * @property string $title
 * @property string $slug
 * @property string $photo
 * @property string $content
 * @property string $seo_h1
 * @property string $seo_title
 * @property string $seo_content
 * @property integer $status
 *
 * @property Page $page
 * @property ArticleComment[] $articleComments
 */
class Article extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'title', 'slug', 'content', 'status'], 'required'],
            [['page_id', 'status'], 'integer'],
            [['content', 'seo_content'], 'string'],
            [['title', 'slug', 'photo', 'seo_h1', 'seo_title'], 'string', 'max' => 255],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::className(), 'targetAttribute' => ['page_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_id' => 'Page ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'photo' => 'Photo',
            'content' => 'Content',
            'seo_h1' => 'Seo H1',
            'seo_title' => 'Seo Title',
            'seo_content' => 'Seo Content',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleComments()
    {
        return $this->hasMany(ArticleComment::className(), ['article_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ArticleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ArticleQuery(get_called_class());
    }
}
