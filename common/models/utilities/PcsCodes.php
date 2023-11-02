<?php

namespace common\models\utilities;

use Yii;

/**
 * This is the model class for table "icd10pcscodes".
 *
 * @property int $id
 * @property string|null $pcs_index
 * @property string|null $pcs_codes
 * @property string|null $proc_descript
 * @property string|null $status
 */
class PcsCodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'icd10pcscodes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pcs_index'], 'string', 'max' => 4],
            [['pcs_codes'], 'string', 'max' => 9],
            [['title'], 'string', 'max' => 161],
            [['status'], 'string', 'max' => 54],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pcs_index' => 'Pcs Index',
            'pcs_codes' => 'Pcs Codes',
            'title' => 'Proc Descript',
            'status' => 'Status',
        ];
    }
}
