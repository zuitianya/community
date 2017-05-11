<?php
namespace frontend\controllers;

use common\models\CatsModel;
use frontend\models\PostForm;
use Yii;
use frontend\controllers\base\BaseController;

class PostController extends BaseController
{
    /**
     * 文章列表
     */
    public function actionIndex(){
        return $this->render('index');
    }

    /**
     * 创建文章
     * @return string
     */
    public function actionCreate()
    {
        $model = new PostForm();
        //获取所有分类
        $cat = CatsModel::getAllCats();
        return $this->render('create',['model'=> $model,'cat'=> $cat]);
    }
}
