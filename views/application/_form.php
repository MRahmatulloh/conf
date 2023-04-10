<?php

/** @var yii\web\View $this */
/** @var app\models\Application $model */

/** @var yii\widgets\ActiveForm $form */

use app\models\Category;
use app\models\Conference;
use kartik\select2\Select2;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\MaskedInput;

?>
<style>
    #application-is_first > label {
        margin-right: 35px;
    }
</style>
<div class="application-form mt-4">
    <div class="container">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-8">
                <?= $form->field($model, 'conference_id')->widget(Select2::className(), [
                    'data' => Conference::selectList(),
                    'options' => [
                        'placeholder' => 'Пожалуйста, Выберите',
                        'disabled' => Yii::$app->controller->id == 'conference'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?>
            </div>
            <div class="col-12"></div>
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
                <?= $form->field($model, 'category_id')->dropDownList([null => 'Пожалуйста, Выберите']) ?>
            </div>
            <div class="col-12"></div>
            <div class="col-6">
                <?= $form->field($model, 'article_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-12"></div>
            <div class="col-4">
                <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
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
            <div class="col-6"></div>
            <?php if (Yii::$app->controller->action->id == 'update'): ?>
                <div class="col-6">
                    <?= $form->field($model, 'status')->dropDownList(\app\models\Application::STATUS_ARRAY) ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>


</div>

<?php
$conference_id = $model->conference_id;

$js = <<<JS
let selected_conference_id = '$conference_id';
$(document).ready(function(){
    
    $('#application-conference_id').on('change', function () {
        let conference_id = $(this).val();
        if (conference_id) {
            let driectionsUrl = '/conference/get-directions';
            $.ajax({
                url: driectionsUrl,
                method: 'get',
                data: {'id': conference_id},
                success: function (data) {
                    $('#application-category_id').html('');
                    let list = JSON.parse(data);
                    
                    if (list.length !== 0){
                        for (var key in list) {
                            $('#application-category_id').append('<option value="'+key+'" '+((selected_conference_id == key) ? "selected" : "")+' >'+list[key]+'</option>');
                        }
                    }else{
                        $('#application-category_id').append('<option value="">На выбранную конференцию нет направлений</option>');
                    }

                }
            });
        }
    });
    
    $('#application-conference_id').trigger('change');
    
});

JS;

$this->registerJs($js);
?>
