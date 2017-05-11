<?php

namespace common\models;

use Yii;
use yii\helpers\Html;
use common\models\base\BaseModel;
use common\models\UserModel;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $cat_id
 * @property string $content
 * @property string $tags
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $author_id
 *
 * @property CommentModel[] $comments
 * @property CatsModel $cat
 * @property User $author
 * @property PoststatusModel $status0
 */
class PostModel extends BaseModel
{
    private $_oldTags;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'cat_id', 'content', 'status', 'author_id'], 'required'],
            [['cat_id', 'status', 'create_time', 'update_time', 'author_id'], 'integer'],
            [['content', 'tags'], 'string'],
            [['title'], 'string', 'max' => 128],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatsModel::className(), 'targetAttribute' => ['cat_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserModel::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => PoststatusModel::className(), 'targetAttribute' => ['status' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content' => '内容',
            'tags' => '标签',
            'status' => '状态',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
            'author_id' => '作者',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(CommentModel::className(), ['post_id' => 'id']);
    }

    public function getActiveComments()
    {
        return $this->hasMany(CommentModel::className(), ['post_id' => 'id'])
            ->where('status=:status',[':status'=>2])->orderBy('id DESC');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(CatsModel::className(), ['id' => 'cat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(UserModel::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(PoststatusModel::className(), ['id' => 'status']);
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->create_time = time();
                $this->update_time = time();
            }
            else
            {
                $this->update_time = time();
            }

            return true;

        }
        else
        {
            return false;
        }
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->_oldTags = $this->tags;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        TagModel::updateFrequency($this->_oldTags, $this->tags);
    }

    public function afterDelete()
    {
        parent::afterDelete();
        TagModel::updateFrequency($this->tags, '');
    }

    public function getUrl()
    {
        return Yii::$app->urlManager->createUrl(
            ['post/detail','id'=>$this->id,'title'=>$this->title]);
    }

    public function getBeginning($length=288)
    {
        $tmpStr = strip_tags($this->content);
        $tmpLen = mb_strlen($tmpStr);

        $tmpStr = mb_substr($tmpStr,0,$length,'utf-8');
        return $tmpStr.($tmpLen>$length?'...':'');
    }

    public function  getTagLinks()
    {
        $links=array();
        foreach(TagModel::string2array($this->tags) as $tag)
        {
            $links[]=Html::a(Html::encode($tag),array('post/index','PostSearch[tags]'=>$tag));
        }
        return $links;
    }

    public function getCommentCount()
    {
        return CommentModel::find()->where(['post_id'=>$this->id,'status'=>2])->count();
    }

}
