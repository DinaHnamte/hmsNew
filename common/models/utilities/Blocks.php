<?php

namespace common\models\utilities;

use Yii;

/**
 * This is the model class for table "blocks".
 *
 * @property string $id
 * @property string|null $blockIdend
 * @property string|null $chapterid
 * @property string|null $title
 */
class Blocks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blocks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'blockIdend'], 'string', 'max' => 3],
            [['chapterid'], 'string', 'max' => 2],
            [['title'], 'string', 'max' => 210],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'blockIdend' => 'Block Idend',
            'chapterid' => 'Chapterid',
            'title' => 'Title',
        ];
    }
}
