<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\ApplicationSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="application-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sender_first_name') ?>

    <?= $form->field($model, 'sender_last_name') ?>

    <?= $form->field($model, 'owners') ?>

    <?= $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'article_name') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'is_first') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'link') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
