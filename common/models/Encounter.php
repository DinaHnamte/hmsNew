<?php

namespace common\models;

use Yii;
use common\models\auth\User;
use common\models\auth\RegUser;
use common\models\auth\Tenant;

/**
 * This is the model class for table "encounter".
 *
 * @property int $id
 * @property string $encounter_type
 * @property int $pat_id
 * @property string $hsp_id
 * @property string $chief_complaint
 * @property string $ref_dept
 * @property string $dr_id
 * @property bool $admit
 * @property int $reg_fee
 * @property int|null $registered_at
 * @property int|null $counter_at
 * @property int|null $session_start_at
 * @property int|null $session_end_at
 */
class Encounter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'encounter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pat_id', 'reg_fee', 'registered_at', 'counter_at', 'session_start_at', 'session_end_at'], 'integer'],
            [['admit', 'btest'], 'boolean'],
            [['encounter_type'], 'string', 'max' => 20],
            [['hsp_id'], 'string', 'max' => 13],
            [['chief_complaint'], 'string', 'max' => 250],
            [['ref_dept', 'dr_id'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'encounter_type' => 'Encounter Type',
            'pat_id' => 'Pat ID',
            'hsp_id' => 'Hsp ID',
            'chief_complaint' => 'Chief Complaint',
            'ref_dept' => 'Ref Dept',
            'dr_id' => 'Dr ID',
            'admit' => 'Admit',
            'btest' => 'Admit',
            'reg_fee' => 'Reg Fee',
            'registered_at' => 'Registered At',
            'counter_at' => 'Counter At',
            'session_start_at' => 'Session Start At',
            'session_end_at' => 'Session End At',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'pat_id']);
    }

    public function getRegUser(){
        return $this->hasOne(RegUser::className(), ['id' => 'pat_id']);
    }

    public function getTenant(){
        return $this->hasOne(Tenant::className(), ['id' => 'hsp_id']);
    }
}
