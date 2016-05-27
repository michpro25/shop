<?php

use backend\helpers\PageHelper;
use common\models\Page;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\search\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Page', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin() ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [

                'id',
                [
                    'attribute' => 'title',
                    'value' => function (Page $page) {
                            return Html::a(Html::encode($page->title), ['view', 'id' => $page->id]);
                        },
                    'format' => 'raw',
                ],
                'slug',
                [
                    'attribute' => 'parent_id',
                    'filter' => PageHelper::getTabList(),
                    'value' => 'parent.title',
                ],
                [
                    'attribute' => 'status',
                    'filter' => PageHelper::getStatusList(),
                    'value' => function (Page $page) {
                            return PageHelper::getStatusName($page->status);
                        },
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

    <?php Pjax::end() ?>
</div>
