<?php

namespace hospital\modules\diseases\models;

use Yii;

/**
 * This is the model class for table "diseases".
 *
 * @property int $id
 * @property int|null $section_id
 * @property string|null $title
 * @property string|null $icd_code
 */
class Diseases extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diseases';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['section_id'], 'integer'],
            [['title'], 'string', 'max' => 45],
            [['icd_code'], 'string', 'max' => 7],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'section_id' => 'Section ID',
            'title' => 'Title',
            'icd_code' => 'Icd Code',
        ];
    }
}
