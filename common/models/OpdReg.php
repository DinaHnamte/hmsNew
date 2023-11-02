<?php

namespace common\models;

use Yii;
use common\models\User;
use common\models\RegUser;

/**
 * This is the model class for table "opdreg".
 *
 * @property int $id
 * @property int $idpat
 * @property int $idHsp
 * @property string $cplaint
 * @property string $refdept
 * @property string $dr
 * @property bool $admit
 * @property string|null $created_at
 */
class OpdReg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opdreg';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpat', 'idhsp'], 'integer'],
            [['admit'], 'boolean'],
            [['created_at'], 'safe'],
            [['cplaint'], 'required'],
            [['cplaint'], 'string', 'max' => 250],
            [['refdept', 'iddr'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idpat' => 'Id Patient',
            'idhsp' => 'Id Hospital',
            'cplaint' => 'Complaint/Insawiselna',
            'refdept' => 'Refdept',
            'iddr' => 'Dr',
            'admit' => 'Admit',
            'created_at' => 'Created At',
        ];
    }

    public static function primaryKey()
    {
    return ['id']; // Change this to your actual primary key field
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }

    public function getRegUser(){
        return $this->hasOne(RegUser::className(), ['user_id' => 'idpat']);
    }
}
