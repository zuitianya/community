<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
?>
        <div id="LoginBox">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div class="login_row">
                <?= $form->field($model, 'username',['inputOptions' => [
                    'placeholder' => '用户名/邮箱','autoComplete'=>'off',]
                ])->textInput(['autofocus' => true]) ?>
            </div>
            <div class="login_row">
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
            <div class="login_verifyCode">
                <?=Html::input('text','LoginForm[verifyCode]','',['class'=>'form-control','id'=>'loginform-verifycode']);?>
                <?php
                echo Captcha::widget(['name'=>'captchaimg','captchaAction'=>'site/captcha','imageOptions'=>['id'=>'captchaimg', 'title'=>'换一个', 'alt'=>'换一个'],'template'=>'{image}']);
                ?>
            </div>
            <div style="margin-left:15px;float: left;">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
                <div style="color:#999;padding-right:15px;margin:1em 0;float: right;">
                    <?= Html::a(Yii::t('common','reset it'), ['site/request-password-reset']) ?>.
                </div>
            <div class="login_row">
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('common','Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>


