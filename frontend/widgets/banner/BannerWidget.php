<?php
namespace frontend\widgets\banner;

use Yii;
use yii\bootstrap\Widget;

class BannerWidget extends Widget
{
    public $items = [];

    public function init()
    {
        $this->items = [
            ['label'=>'demo','image_url'=>'','url'=>['site/index']],
            ['label'=>'demo','image_url'=>'','url'=>['site/index']],
            ['label'=>'demo','image_url'=>'','url'=>['site/index']],
        ];
    }

    public function run()
    {
        return $this->render('index');
    }
}
