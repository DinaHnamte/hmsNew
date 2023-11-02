<?php

namespace common\models;

use Yii;
use common\models\auth\RegUser;
use common\models\auth\User;

/**
 * This is the model class for table "staff".
 *
 * @property int $id
 * @property int $idhsp
 * @property int $user_id
 * @property int $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 
 * @property Reguser $idreguser0
 * @property User $user
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tenant_id', 'user_id'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tenant_id' => 'Idhsp',
            'user_id' => 'User ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    

    /**
     * Gets query for [[Idreguser0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegUser()
    {
        return $this->hasOne(Reguser::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getEmpDept()
    {
        return $this->hasOne(EmployeeDept::class, ['emp_id' => 'id', 'tenant_id' => 'tenant_id']);
    }
}
