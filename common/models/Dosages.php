<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dosages".
 *
 * @property int $id
 * @property int $med_id
 * @property string $dose
 */
class Dosages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dosages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['med_id', 'dose'], 'required'],
            [['med_id'], 'integer'],
            [['dose'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'med_id' => 'Med ID',
            'dose' => 'Dose',
        ];
    }

    public function getMyMedicines(){
        return $this->hasOne(MyMedicines::className(), ['med_id' => 'med_id']);
    }
}
