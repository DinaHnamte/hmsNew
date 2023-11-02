<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mymedicines".
 *
 * @property int $id
 * @property int $doc_id
 * @property int $med_id
 * @property string $name
 */
class Mymedicines extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mymedicines';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doc_id', 'med_id', 'name'], 'required'],
            [['doc_id', 'med_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doc_id' => 'Doc ID',
            'med_id' => 'Med ID',
            'name' => 'Name',
        ];
    }
}
