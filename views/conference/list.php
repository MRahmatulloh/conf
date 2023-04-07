<?php

use app\models\Conference;
use yii\bootstrap5\LinkPager;
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
<style>
    .ribbon1 span{
        width: 100px!important;
        font-size: 15px!important;
    }
    .ribbon1::after{
        border-left: 50px solid transparent!important;
        border-right: 50px solid transparent!important;
        border-top: 20px solid #884ffb!important;
    }
    .white_card{
        background-color: #fff!important;
        border-radius: 10px!important;
        box-shadow: 0 0 10px 0 rgba(0,0,0,.1)!important;
    }
    .white_card:hover{
        box-shadow: 0 0 10px 0 rgba(0,0,0,.2)!important;
        transition: all .3s ease-in-out!important;
        transform: scale(1.02)!important ;
    }

    .short{
        height: 200px;
        overflow: hidden;
        text-align: justify;
    }

    .place{
        text-align: justify;
    }

    .title{
        text-align: justify;
    }
    .main_content_iner{
       background-image: url('/img/some_bg.jpg')!important;
    }

    .main_content .main_content_iner{
        min-height: 85vh!important
    }

</style>
<div class="conference-index">

    <div class="row mb-3">
        <div class="col-6">
            <h2 class="text-white"><?= Html::encode($this->title) ?></h2>
        </div>
        <div class="col-6">
            <p class="text-right">
            </p>
        </div>
    </div>


    <div class="container">

        <div class="row">
            <?php if ($dataProvider->models): ?>

                <?php /** @var Conference $model */
                foreach ($dataProvider->models as $model): ?>

                    <div class="col-md-4">
                        <div class="white_card position-relative mb_20 ">
                            <div class="card-body">
                                <div class="ribbon1 rib1-primary"><span
                                            class="text-white text-center rib1-primary"><?= $model->getDateTitle() ?></span></div>
                                <p class="text-left text-break mt-5 p-1 f_w_700 text-dark fs-6 title">
                                    <?= $model->name ?>
                                </p>
                                <div class="row my-3 short">
                                    <div class="col-auto">
                                        <p class="text-dark f_w_400">
                                            <?= $model->short ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-auto">
                                        <p class="text-dark fs-6 place f_w_600">
                                            <i class="ti ti-location-pin fs-4 "> </i> <?= $model->place ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <a href="<?= Url::to(['conference/details', 'id' => $model->id]) ?>"
                                       class="btn_1 text-center">Batafsil</a>
                                </div>
                            </div>

                        </div>
                    </div>

                <?php endforeach; ?>

                <?= LinkPager::widget([
                    'pagination' => $dataProvider->pagination,
                ]); ?>

            <?php endif; ?>
        </div>

    </div>


</div>
