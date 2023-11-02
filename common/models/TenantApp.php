<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tenantapp".
 *
 * @property int $id
 * @property string $app_id
 * @property int $tenant_id
 */
class TenantApp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tenantapp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['app_id', 'tenant_id'], 'required'],
            [['tenant_id'], 'string', 'max' => 13],
            [['app_id'], 'string', 'max' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'app_id' => 'App ID',
            'tenant_id' => 'Tenant ID',
        ];
    }
}
