<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <title>Easy Contract Admin</title>
    <link rel="icon" href=<?= Yii::getAlias('@web') ?>"/img/af.jpg" type="image/png">
</head>
<body class="crm_body_bg">
<?php $this->beginBody() ?>

<nav class="sidebar dark_sidebar">
    <div class="logo d-flex justify-content-between">
        <a class="large_logo" href="/site/index"><img src=<?= Yii::$app->request->baseUrl . '/img/logoengl3.svg'; ?> alt=""></a>
        <a class="small_logo" href="/site/index"><img src=<?= Yii::$app->request->baseUrl ?>"/img/af.jpg" alt="" width="80px"></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <?php if (!Yii::$app->user->isGuest): ?>
            <li class="">
                <a href="/dashboard/*" aria-expanded="false">
                    <div class="nav_icon_small">
                        <img src="/img/menu-icon/dashboard.svg" alt="">
                    </div>
                    <div class="nav_title">
                        <span>Дашборд</span>
                    </div>
                </a>
            </li>

            <li class="">
                <a class="has-arrow" href="#" aria-expanded="false">
                    <div class="nav_icon_small">
                        <img src="/img/menu-icon/11.svg" alt="">
                    </div>
                    <div class="nav_title">
                        <span>Конференция</span>
                    </div>
                </a>
                <ul>
                    <li><a href="/conference/create">Добавить Конференция</a></li>
                    <li><a href="/conference/index">Список Конференции</a></li>
                    <li><a href="/conference/list">Список Конференции</a></li>
                </ul>
            </li>

            <li class="">
                <a href="/application/index" aria-expanded="false">
                    <div class="nav_icon_small">
                        <img src="/img/menu-icon/20.svg" alt="">
                    </div>
                    <div class="nav_title">
                        <span>Заявки</span>
                    </div>
                </a>
            </li>
        <?php endif; ?>

        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->can('Administrator')): ?>
            <li class="">
                <a class="has-arrow" href="#" aria-expanded="false">
                    <div class="nav_icon_small">
                        <img src="/img/menu-icon/18.svg" alt="">
                    </div>
                    <div class="nav_title">
                        <span>RBAC</span>
                    </div>
                </a>
                <ul>
                    <li><a href="/admin/user">Пользователи</a></li>
                    <li><a href="/admin/assignment">Назначения</a></li>
                    <li><a href="/admin/role">Роли</a></li>
                    <li><a href="/admin/route">Роуты</a></li>
                    <li><a href="/admin/rule">Правилы</a></li>
                    <li><a href="/admin/permission">Разрешения</a></li>
                </ul>
            </li>
        <?php endif; ?>

        <li class="">
            <a href="/application/create/" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="/img/menu-icon/13.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Новая заявка</span>
                </div>
            </a>
        </li>

    </ul>
</nav>

<section class="main_content dashboard_part large_header_bg">

        <div class="container-fluid g-0">
            <div class="row">
                <div class="col-lg-12 p-0 ">
                    <div class="header_iner d-flex justify-content-between align-items-center">
                        <div class="sidebar_icon d-lg-none">
                            <i class="ti-menu"></i>
                        </div>
                        <div class="line_icon open_miniSide d-none d-lg-block">
                            <img src="/img/line_img.png" alt="">
                        </div>
                        <?php if (!Yii::$app->user->isGuest):?>
                        <div class="serach_field-area d-flex align-items-center d-none">
                            <div class="search_inner d-none">
                                <form action="#">
                                    <div class="search_field">
                                        <input type="text" placeholder="Search">
                                    </div>
                                    <button type="submit"><img src="/img/icon/icon_search.svg" alt=""></button>
                                </form>
                            </div>
                        </div>
                        <div class="header_right d-flex justify-content-between align-items-center">
                            <div class="header_notification_warp d-flex align-items-center">
                                <li>
                                    <a class="bell_notification_clicker" href="#"> <img src="/img/icon/bell.svg" alt="">
                                        <span>2</span>
                                    </a>

                                    <div class="Menu_NOtification_Wrap">
                                        <div class="notification_Header">
                                            <h4>Notifications</h4>
                                        </div>
                                        <div class="Notification_body">

                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="/img/staf/2.png" alt=""></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#"><h5>Cool Marketing </h5></a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>

                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="/img/staf/4.png" alt=""></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#"><h5>Awesome packages</h5></a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>

                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="/img/staf/3.png" alt=""></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#"><h5>what a packages</h5></a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nofity_footer">
                                            <div class="submit_button text-center pt_20">
                                                <a href="#" class="btn_1">See More</a>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                            </div>
                            <div class="profile_info">
                                <img src="/img/client_img.png" alt="#">
                                <div class="profile_info_iner">
                                    <div class="profile_author_name">
                                        <h5><?= Yii::$app->user->identity->fio ?? null; ?></h5>
                                    </div>
                                    <div class="profile_info_details">
                                        <a href="#">Мой профиль </a>
                                        <form action="/site/logout" method="post">
                                            <input type="hidden" name="_csrf"
                                                   value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                                            <input type="submit" class="btn btn-danger w-100" value="Выйти"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>


    <div class="main_content_iner overly_inner">
        <div class="container-fluid p-0 ">

            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-bs-dismiss="alert" class="close" type="button">×</button>
                    <h5><i class="icon fa fa-check"></i>
                        <?= Yii::$app->session->getFlash('success') ?>
                    </h5>
                </div>
            <?php endif; ?>

            <?php if (Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-bs-dismiss="alert" class="close" type="button">×</button>
                    <h5><i class="icon fa fa-exclamation"></i>
                        <?= Yii::$app->session->getFlash('error') ?>
                    </h5>
                </div>
            <?php endif; ?>

            <?php echo $content; ?>

        </div>
    </div>

    <div class="footer_part">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer_iner text-center">
                        <p><?= date('Y'); ?> © Toshkent Amaliy Fanlar Universiteti. - Created by <a href="https://t.me/mrahmatulloh"> <i
                                        class="ti-user"></i> </a><a href="https://t.me/mrahmatulloh"> Rahmatulloh</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
