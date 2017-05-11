<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Hi!<?php Yii::$app->user->identity->username ?></h1>
    </div>
</div>
