<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\PoststatusModel;
use common\models\UserModel;

/* @var $this yii\web\View */
/* @var $model common\models\PostModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cat_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')
            ->dropDownList(PoststatusModel::find()
                ->select(['name','id'])
                ->orderBy('position')
                ->indexBy('id')
                ->column(),
            ['prompt'=>'请选择状态']); ?>

    <?= $form->field($model, 'author_id')
            ->dropDownList(UserModel::find()
                ->select(['nickname','id'])
                ->indexBy('id')
                ->column(),
            ['prompt'=>'请选择作者']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
