<?php

namespace common\models;

use Yii;
use common\models\EmployeeDept;

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
class EmployeeDept extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee_dept';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tenant_id', 'emp_id', 'dept_id', 'user_id'], 'required'],
            [['emp_id', 'dept_id', 'user_id'], 'integer']
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
            'emp_id' => 'Employee',
            'user_id' => 'User Name',
            'dept_id' => 'Department'
        ];
    }

    
    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(User::class, ['id' => 'emp_id']);
    }

    public function getDept()
    {
        return $this->hasOne(Dept::class, ['id' => 'dept_id']);
    }
}
