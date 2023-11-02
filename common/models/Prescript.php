<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "prescript".
 *
 * @property string $id
 * @property string $prescript_dt
 * @property int $encounter_id
 * @property int $med_id
 * @property string $medi
 * @property string $dose
 */
class Prescript extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prescript';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prescript_dt'], 'safe'],
            [[ 'med_id'], 'integer'],
            [['encounter_id'], 'string', 'max' => 13],
            [['medi', 'dose'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prescript_dt' => 'Prescript Dt',
            'encounter_id' => 'Encounter ID',
            'med_id' => 'Med ID',
            'medi' => 'Medi',
            'dose' => 'Dose',
        ];
    }
}
