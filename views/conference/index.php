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

            'name',
            'start_date',
            'end_date',
            'description:ntext',
            //'link',
            //'filename',
            'status',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Conference $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
