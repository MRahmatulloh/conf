<?php

/** @var yii\web\View $this */
/** @var app\models\Application $model */
/** @var yii\widgets\ActiveForm $form */

use app\models\Application;
use kartik\select2\Select2;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

?>
<style>
    #application-is_first>label {
        margin-right: 35px;
    }
</style>
<div class="application-form mt-4">
    <div class="container">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-4">
                <?= $form->field($model, 'sender_first_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-4">
                <?= $form->field($model, 'sender_last_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'owners')->textarea(['rows' => 1]) ?>
            </div>
            <div class="col-6"></div>
            <div class="col-6">
                <?= $form->field($model, 'category_id')->widget(Select2::className(),[
                    'data' => Application::CATERORIES,
                    'options' => ['placeholder' => 'Пожалуйста, Выберите'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?>
            </div>
            <div class="col-12"></div>
            <div class="col-6">
                <?= $form->field($model, 'article_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-12"></div>
            <div class="col-4">
                <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, [
                    'mask' => '99-999-99-99',
                ]) ?>
            </div>
            <div class="col-4">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'comment')->textarea(['rows' => 1]) ?>
            </div>
            <div class="col-12"></div>
            <div class="col-6">
                <?= $form->field($model, 'file')->fileInput() ?>
            </div>
            <div class="col-12"></div>
            <div class="col-4">
                <?= $form->field($model, 'is_first')->radioList([
                    1 => 'Да',
                    0 => 'Нет',
                ]) ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>


</div>
