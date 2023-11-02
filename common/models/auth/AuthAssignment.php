<?php

namespace common\models\auth;

use common\models\auth\User;
use common\models\auth\RegUser;
use Yii;

/**
 * This is the model class for table "auth_assignment".
 *
 * @property string $item_name
 * @property string $user_id
 * @property int|null $created_at
 *
 * @property AuthItem $itemName
 */
class AuthAssignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'tenant_id'], 'required'],
            [['created_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'role_id' => 'Role Id',
            'user_id' => 'User ID',
            'tenant_id' => 'HSP ID',
            'created_at' => 'Created At',
        ];
    }

    public static function assignRole($roleId, $userId, $tenantId)
    {        
        $x = static::find()->where([
            'role_id' => $roleId, 
            'user_id' => $userId, 
            'tenant_id' => $tenantId])->count();
        if($x>0){
            return false;
        }            
        Yii::$app->db->createCommand()
            ->insert('auth_assignment', [
            'role_id' => $roleId,
            'user_id' => $userId,
            'tenant_id' => $tenantId,
            'created_at' => time(),
            ])->execute();
        return true;
    }

    public static function revokeRole($roleId, $userId, $tenantId)
    {        
        $x = static::find()->where([
            'role_id' => $roleId, 
            'user_id' => $userId, 
            'tenant_id' => $tenantId])->count();
        if($x>0){
            $mdl = static::find()->where(['role_id' => $roleId,
            'user_id' => $userId,
            'tenant_id' => $tenantId]);
            Yii::$app->db->createCommand()
                        ->delete('auth_assignment', 
                        ['role_id' => $roleId,
                        'user_id' => $userId,
                        'tenant_id' => $tenantId,])
                        ->execute();
            return true;
        } 
        return false;
    }
	
	public function getRole()
    {
        return $this->hasOne(AuthRole::class, ['id' => 'role_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }   
    
    public function getApp()
    {
        return $this->hasOne(App::class, ['id' => 'app_id']);
    }
}
