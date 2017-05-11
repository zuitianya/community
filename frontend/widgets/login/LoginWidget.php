<?php
namespace frontend\widgets\login;
/**
 * login 组件
 */
use Yii;
use yii\bootstrap\Widget;

class LoginWidget extends Widget
{

    public function init()
    {
    }

    public function run()
    {
        return $this->render('index');
    }
}