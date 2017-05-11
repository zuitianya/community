<?php
use yii\bootstrap\ActiveForm;
use frontend\models\LoginForm;
use yii\helpers\Html;

$this->title = 'community';
?>
        <!--    表单弹窗组件-->
        <?php if(Yii::$app->user->isGuest):?>
        <?=\frontend\widgets\login\LoginWidget::widget()?>
        <?php endif;?>
<div class="row">
    <div class="col-lg-9">

    </div>
    <div class="col-lg-3">
        qq
    </div>

</div>
