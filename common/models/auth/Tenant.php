<?php

namespace common\models\auth;

use Yii;

/**
 * This is the model class for table "tenants".
 *
 * @property string $id
 * @property string $app_id
 * @property int $regby_id
 * @property string $email
 * @property string $name
 * @property string $mobno
 * @property string $add1
 * @property string $dist
 * @property int $status
 * @property string $type
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Tenant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tenants';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'app_id', 'regby_id'], 'required'],
            [['regby_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['id'], 'string', 'max' => 13],
            [['app_id', 'mobno', 'type'], 'string', 'max' => 10],
            [['email'], 'string', 'max' => 250],
            [['name', 'add1', 'dist'], 'string', 'max' => 50],
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
            'app_id' => 'App ID',
            'regby_id' => 'Regby ID',
            'email' => 'Email',
            'name' => 'Name',
            'mobno' => 'Mobno',
            'add1' => 'Add1',
            'dist' => 'Dist',
            'status' => 'Status',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getRegUser()
    {
        return $this->hasOne(Reguser::class, ['id' => 'regby_id']);
    }
}
