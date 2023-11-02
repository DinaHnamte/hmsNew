<?php

namespace common\models\utilities;

use Yii;

/**
 * This is the model class for table "pcsindex".
 *
 * @property string $id
 * @property string|null $op_procedure
 * @property string|null $description
 */
class PcsIndex extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pcsindex';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'string', 'max' => 4],
            [['op_procedure'], 'string', 'max' => 44],
            [['description'], 'string', 'max' => 167],
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
            'op_procedure' => 'Op Procedure',
            'description' => 'Description',
        ];
    }
}
