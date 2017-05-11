<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PostModel */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '文章管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除这篇文章吗？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
            'tags:ntext',
            //'status',
            [
                'label'=>'状态',
                'value'=>$model->status0->name,
            ],
            //'create_time:datetime',
            [
                'attribute'=>'create_time',
                'value'=>date('Y-m-d H:i:s',$model->create_time)
            ],
            //'update_time:datetime',
            [
                'attribute'=>'update_time',
                'value'=>date('Y-m-d H:i:s',$model->update_time)
            ],
            //'author_id',
            [
                'attribute'=>'author_id',
                'value'=>$model->author->nickname
            ],
        ],
        'template'=>'<tr><th style="width:120px;">{label}</th><td>{value}</td></tr>',
        //'options'=>['style'=>'background:#369']
    ]) ?>

</div>
