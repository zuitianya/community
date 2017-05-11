<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\PoststatusModel;
use common\models\CatsModel;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php //$searchModel = new common\models\Tag();?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            ['attribute'=>'id',
                'contentOptions'=>['width'=>'30px'],
            ],
            'title',

            //'cat_id',
            [
                'attribute'=>'cat_id',
                'label'=>'文章分类',
                'value'=>'cat.cat_name',
                'filter'=>CatsModel::find()
                    ->select(['cat_name','id'])
                    ->indexBy('id')
                    ->column(),
            ],

            //'author_id',
            [
                'attribute'=>'authorName',
                'label'=>'作者',
                'value'=>'author.nickname',
                'contentOptions'=>['width'=>'120px'],
            ],
            // 'content:ntext',
            'tags:ntext',

            //'status',
            [
                'attribute'=>'status',
                'value'=>'status0.name',
                'filter'=>PoststatusModel::find()
                    ->select(['name','id'])
                    ->orderBy('position')
                    ->indexBy('id')
                    ->column(),
            ],
            // 'create_time:datetime',

            //'update_time:datetime',
            [
                'attribute'=>'update_time',
                'format'=>['date','php:Y-m-d H:i:s'],
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
