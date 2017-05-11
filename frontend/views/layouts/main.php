<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="Stylesheet" type="text/css" href="/statics/css/login.css" />
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::t('common','Blog'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $rightMenus = [
        ['label' => Yii::t('yii','Home'), 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $rightMenus[] = ['label' => Yii::t('common','Signup'), 'url' => ['/site/signup']];
        $rightMenus[] ='<li>'. Html::a('登录', '#', [
            'id' => 'login',
            'data-toggle' => 'modal',
            'data-target' => '#create-modal',
        ]).'</li>';
    } else {
        $rightMenus[] = ['label' => Yii::t('common','Post'), 'url' => ['/post/index']];
        $rightMenus[] =  [
            'label' => Yii::t('common','Message'),
            'url' => ['/site/member'],
            'linkOptions' => ['class' => 'message'],
            'items' => [
                ['label'=> Yii::t('common','My Message'),'url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],
                ['label'=> Yii::t('common','My Notice'),'url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],

            ]
        ];
        $rightMenus[] =  [
            'label' => '<img src = "'.Yii::$app->params['avatar']['small'].'" alt = "'.Yii::$app->user->identity->username.'">',
            'url' => ['/site/member'],
            'linkOptions' => ['class' => 'avatar'],
            'items' => [
                ['label'=> Yii::t('common','My Post'),'url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],
                ['label'=> Yii::t('common','My Collection'),'url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],
                ['label'=> Yii::t('common','Personal Information'),'url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],
                ['label'=> '<i class = "fa fa-sign-out"> '.Yii::t('common','Logout').'</i>','url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],
            ]
           // 'linkOptions' => ['data-method' => 'post']

        ];
    }
//    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav navbar-left'],
//        'items' => $leftMenus,
//    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $rightMenus,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
