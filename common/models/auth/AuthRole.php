<?php

namespace common\models\auth;

use Yii;

/**
 * This is the model class for table "auth_item".
 *
 * @property string $name
 * @property int $type
 * @property string|null $description
 * @property string|null $rule_name
 * @property resource|null $data
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthRule $ruleName
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItemChild[] $authItemChildren0
 * @property AuthItem[] $children
 * @property AuthItem[] $parents
 */
class AuthRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'app_id'], 'required'],
            [['description'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'app_id' => 'App Id',
            'description' => 'Description',
        ];
    }

    public static function getRole($roleName, $appId)
    {        
        return static::find()->where(['name' => $roleName,
                    'app_id' => $appId])->one();
        
    }

    public static function getRoles($roleName, $appId)
    {        
        return static::find()->where(['name' => $roleName,
                    'app_id' => $appId])->all();
        
    }

    public static function createRole($roleName, $appId, $description)
    {   
        $x = static::find()->where(['name' => $roleName,
                    'app_id' => $appId])->count(); 
        if($x > 0)  {
            return false;
        }          
        Yii::$app->db->createCommand()->insert('auth_role', [
                            'name' => $roleName,
                            'app_id' => $appId,
                            'description' => $description
            ])->execute();
        return true;        
    }

    public static function removeRole($roleId)
    {        
        $x = static::find()->where([
            'id' => $roleId])->count();
        if($x>0){            
            Yii::$app->db->createCommand()
                        ->delete('auth_role', 
                        ['id' => $roleId])
                        ->execute();
            return true;
        } 
        return false;
    }

    /**
     * Gets query for [[AuthAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['item_name' => 'name']);
    }

    
    public function getApp()
    {
        return $this->hasOne(App::class, ['id' => 'app_id']);
    }
}
