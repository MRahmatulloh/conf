<?php

use app\models\Conference;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\ConferenceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Список конференций';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conference-index">

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
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function(Conference $model){
                    return Html::a($model->name, ['directions', 'id' => $model->id]);
                },
            ],
            'start_date',
            'end_date',
            'accepting_end',
            'responsible_person',
            'responsible_tel',
            'place',

            [
                'attribute' =>'status',
                'value' => function(Conference $model){
                    return $model->getStatusName();
                },
            ],

            [
                'class' => ActionColumn::className(),
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, Conference $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
