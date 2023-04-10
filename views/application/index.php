<?php

use app\assets\AppAsset;
use app\models\Application;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

/** @var yii\web\View $this */
/** @var app\models\search\ApplicationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Список заявок';
$this->params['breadcrumbs'][] = $this->title;
AppAsset::register($this);
?>
<div class="application-index">

    <div class="row mb-3">
        <div class="col-6">
            <h2><?= Html::encode($this->title) ?></h2>
        </div>
        <div class="col-6">
            <p class="text-right">
                <?= Html::a("<i class='fas fa-plus white_text'></i> " . ' ', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Дата создания',
                'value' => function (Application $model) {
                    return date('d.m.Y H:i:s', $model->created_at);
                }
            ],

            [
                'attribute' => 'conference_id',
                'value' => function (Application $model) {
                    return $model->conference->name ?? '';
                },
            ],

            'sender_first_name',

            'sender_last_name',

            'owners:ntext',

            [
                'attribute' => 'category_id',
                'value' => function (Application $model) {
                    return $model->conference ?? '';
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'category_id',
                    'data' => \app\models\Category::selectList() ?? '',
                    'initValueText' => $searchModel->category_id,
                    'options' => ['placeholder' => 'Выберите ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            'article_name',
            'comment:ntext',
            'phone',
            'email:email',

            [
                'attribute' => 'is_first',
                'value' => function(Application $model){
                    return $model->is_first ? 'Да' : 'Нет';
                }
            ],

            [
                'attribute' => 'status',
                'value' => function(Application $model){
                    return Application::STATUS_ARRAY[$model->status];
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'status',
                    'data' => Application::STATUS_ARRAY,
                    'initValueText' => $searchModel->status,
                    'options' => ['placeholder' => 'Выберите ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Application $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
