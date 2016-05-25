<?php

namespace common\models;

use common\models\query\ArticleCommentQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%article_comment}}".
 *
 * @property integer $id
 * @property integer $article_id
 * @property integer $user_id
 * @property string $email
 * @property string $name
 * @property string $content
 * @property integer $status
 *
 * @property Article $article
 * @property User $user
 */
class ArticleComment extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'content', 'status'], 'required'],
            [['article_id', 'user_id', 'status'], 'integer'],
            [['content'], 'string'],
            [['email', 'name'], 'string', 'max' => 255],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
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
            'article_id' => 'Article ID',
            'user_id' => 'User ID',
            'email' => 'Email',
            'name' => 'Name',
            'content' => 'Content',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
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
     * @return ArticleCommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ArticleCommentQuery(get_called_class());
    }
}
