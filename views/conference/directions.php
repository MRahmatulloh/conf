<?php

use app\models\Category;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\CategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Направления конференции';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h2><?= $this->title ?></h2>

    <div class="category-form">

        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model->conference, 'name')->textInput(['maxlength' => true, 'disabled' => true])->label('Конференция') ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-3">
                <h6> </h6>
                <div class="form-group">
                    <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
                    <?= Html::a('Назад в список', 'index', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'class' => ActionColumn::className(),
                'template' => '{delete}',
                'urlCreator' => function ($action, Category $model, $key, $index, $column) {
                    return Url::toRoute(['category/delete', 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
