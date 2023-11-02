<?php

namespace common\models;

use Yii;
use common\models\utilities\Icd10;

/**
 * This is the model class for table "myicd10".
 *
 * @property int $id
 * @property int $user_id
 * @property int $chapterid
 * @property int $blockid
 * @property int $icd10id
 * @property string $title
 */
class MyIcd10 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'myicd10';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'chapterid', 'blockid', 'icd10id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'chapterid' => 'Chapterid',
            'blockid' => 'Blockid',
            'icd10id' => 'Icd10id',
            'title' => 'Title',
        ];
    }

        public function getIcd10()
    {
        return $this->hasOne(Icd10::className(), ['id' => 'icd10id']);
    }
}
