<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Conference $model */

$this->title = 'Создать конференцию';
$this->params['breadcrumbs'][] = ['label' => 'Conferences', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conference-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
