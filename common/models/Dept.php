<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property int $id
 * @property string $hsp_id
 * @property string $name
 */
class Dept extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dept';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tenant_id', 'name'], 'required'],
            [['tenant_id'], 'string', 'max' => 13],
            [['name'], 'string', 'max' => 100],
            [['active'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tenant_id' => 'Hsp ID',
            'name' => 'Dept Name',
            'active:boolean' => 'Active',
        ];
    }
}
