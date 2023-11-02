<?php

namespace common\models\auth;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "reguser".
 *
 * @property int $id
 * @property bool $pwd
 * @property string $name
 * @property string $fname
 * @property string $dob
 * @property string $sex
 * @property string $tribe
 * @property string $commu
 * @property string $bg
 * @property string $mobno
 * @property string $add1
 * @property string $dist
 * @property string|null $created_dt
 * @property string|null $updated_dt
 */
class RegUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reguser';
    }

        /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'dob', 'name', 'fname', 'add1', 'dist', 'sex', 'tribe', 'bg', 'mobno', 'commu', 'religion'], 'required'],
            [['id'], 'integer'],
            [['mobno'], 'number', 'min' => 1000000000, 'max' => 9999999999],
            [['pwd'], 'boolean'],
            [['dob'], 'safe'],
            [['name', 'fname', 'add1', 'dist'], 'string', 'max' => 50],
            [['sex', 'tribe', 'bg'], 'string', 'max' => 10, 'min' => 1],
            [['commu'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'User ID',
            'pwd' => 'Pwd',
            'name' => 'Name',
            'fname' => 'Father Name',
            'dob' => 'Dob',
            'sex' => 'Sex',
            'tribe' => 'Tribe',
            'commu' => 'Community',
            'religion' => 'Religion',
            'bg' => 'Blood group',
            'mobno' => 'Mobno',
            'add1' => 'Address',
            'dist' => 'District',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id']);
    }
}
