<?php

use app\assets\AppAsset;
use kartik\datetime\DateTimePicker;
use mihaildev\ckeditor\CKEditor;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Conference $model */
/** @var yii\widgets\ActiveForm $form */
AppAsset::register($this);
?>

<div class="conference-form mt-3">

    <?php $form = ActiveForm::begin(); ?>

    <div class="container m-auto">
        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-4">
                <?php echo $form->field($model, 'accepting_end')->widget(DateTimePicker::classname(), [
                    'options' => ['placeholder' => 'Enter event time ...'],
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
                ]); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'start_date')->widget(DateTimePicker::classname(), [
                    'options' => ['placeholder' => 'Enter event time ...'],
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
                ]); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'end_date')->widget(DateTimePicker::classname(), [
                    'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                    'options' => ['placeholder' => 'Enter event time ...'],
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
                ]); ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'short')->textarea(['rows' => 2]) ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'description')->widget(CKEditor::className(),[
                    'editorOptions' => [
                        'preset' => 'full',
                        'inline' => false,
                        'height' => 150,
                    ],
                ]); ?>
            </div>
            <div class="col-md-5">
                <?= $form->field($model, 'responsible_person')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'responsible_tel')->widget(\yii\widgets\MaskedInput::class, [
                    'mask' => '(99)-999-99-99',
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'infoFile')->fileInput() ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'file')->fileInput() ?>
            </div>
            <div class="col-12"></div>
            <div class="col-6">
                <?= $form->field($model, 'status')->radioList([
                    1 => 'Активный',
                    0 => 'Неактивный',
                ]) ?>
            </div>
            <div class="col-12"></div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
