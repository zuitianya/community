<?php

namespace common\models;
use common\models\base\BaseModel;

use Yii;

/**
 * This is the model class for table "commentstatus".
 *
 * @property integer $id
 * @property string $name
 * @property integer $position
 *
 * @property CommentModel[] $comments
 */
class CommentstatusModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'commentstatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'position'], 'required'],
            [['position'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'position' => 'Position',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(CommentModel::className(), ['status' => 'id']);
    }
}
