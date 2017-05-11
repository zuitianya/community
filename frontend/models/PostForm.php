<?php
namespace frontend\models;
/**
 * 文章表单模型
 */

use yii\base\Model;
use yii;


class PostForm extends Model
{
    public $id;
    public $title;
    public $content;
//    public $label_img;
    public $tags;
    public $cat_id;

    public $_lastError = "";

    public function rules()
    {
        return [
            [['id','title','content'],'required'],
            ['id','integer'],
            ['title','string','min'=>3,'max'=>50],
        ];
    }



    public function attributeLabels()
    {
        return[
            'id'=>'编码',
            'title'=>'标题',
            'content'=>'内容',
            'tags'=>'标签',
            'cat_id'=>'分类',
        ];
    }

















}