<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Conference $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Conferences', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('/vendors/flipdown/dist/flipdown.js');
$this->registerCssFile('/vendors/flipdown/dist/flipdown.css');
?>
<style>
    .description p, strong{
        text-align: justify!important;
        color: black!important;
        font-size: medium;
    }
</style>
<div class="conference-view container">

    <h1 class="text-center mb-5 text-dark">ANJUMAN HAQIDA</h1>

    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <div id="flipdown" class="flipdown flipdown__theme-dark"></div>
        </div>
        <div class="col-md-6 text-dark">
            <h3 class="text-dark mb-4 text-justify"><?= $model->name ?></h3>
            <p class="text-dark mb-4 fs-5 text-justify"><?= $model->short ?></p>
            <p class="text-dark mb-2 fs-4">Registratsiyadan o'tishning oxirgi muddati:</p>
            <p class="text-dark mb-4 fs-5 fw-bold"><?= Yii::$app->formatter->asDate($model->accepting_end, 'php:d.m.Y H:i:s') ?></p>
            <p class="text-dark mb-3 fs-4">Mas'ul shaxs: <?= $model->getResponsibleInfo() ?></p>
            <p class="text-dark mb-2 fs-4">Shablon:</p>
            <a href="<?= $model->filename ?>" download class="btn btn-primary mb-2">Shablonni yuklab olish</a>

            <?php if ($model->status): ?>
                <a href="conference/apply" class="btn btn-danger d-block">Ishtirok etish</a>
            <?php endif;?>
        </div>
        <div class="col-md-12 mt-5 description">
            <h3 class="text-center mb-3">Axborot xati</h3>
            <p class="text-dark mb-4 fs-5 text-justify"><?= $model->description ?></p>
        </div>
    </div>

</div>

<?php
$time = strtotime($model->accepting_end);

$js = <<<JS

let timestamp = $time;
$(document).ready(function(){

  // Set up FlipDown
  var flipdown = new FlipDown(timestamp)

    // Start the countdown
    .start()

    // Do something when the countdown ends
    .ifEnded(() => {
      console.log('The countdown has ended!');
    });
  
  var ver = document.getElementById('ver');
  ver.innerHTML = flipdown.version;
});

JS;

$this->registerJs($js);
?>
