<?php

namespace backend\helpers;

use common\models\Page;
use yii\helpers\ArrayHelper;

class PageHelper
{
    public static function getTabList()
    {
        return Page::find()->orderBy('title')->select(['title', 'id'])->indexBy('id')->column();
    }

    public static function getStatusList()
    {
        return [
            Page::STATUS_DRAFT => 'Черновик',
            Page::STATUS_ACTIVE => 'Опубликован',
        ];
    }

    public static function getStatusName($status)
    {
        return ArrayHelper::getValue(self::getStatusList(), $status);
    }
} 