<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "section".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $type
 */
class VitalSign extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vitalsign';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pat_id'], 'integer'],
            [['encounter_id'], 'string', 'max' => 13],
            [['value'], 'string', 'max' => 10],
            [['type'], 'string', 'max' => 15],
            [['value', 'type'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'encounter_id' => 'Encounter Id',
            'pat_id'  => 'Patient Id',
            'value' => 'Value',
            'type' => 'Type',
        ];
    }
}
