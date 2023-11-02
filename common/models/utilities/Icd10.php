<?php

namespace common\models\utilities;

use Yii;

/**
 * This is the model class for table "icd10".
 *
 * @property int $id
 * @property int|null $Level
 * @property string|null $Category
 * @property string|null $chapterid
 * @property string|null $blockid
 * @property string|null $Dagger
 * @property string|null $Aster
 * @property string|null $WithoutDot
 * @property string|null $Title
 * @property string|null $Mortality1
 * @property string|null $Mortality2
 * @property string|null $Mortality3
 * @property string|null $Mortality4
 * @property string|null $Mortality5
 */
class Icd10 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'icd10';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Level'], 'integer'],
            [['Category'], 'string', 'max' => 1],
            [['chapterid'], 'string', 'max' => 2],
            [['blockid'], 'string', 'max' => 3],
            [['Dagger', 'Aster', 'WithoutDot'], 'string', 'max' => 6],
            [['Title'], 'string', 'max' => 255],
            [['Mortality1', 'Mortality2', 'Mortality3', 'Mortality4', 'Mortality5'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Level' => 'Level',
            'Category' => 'Category',
            'chapterid' => 'Chapterid',
            'blockid' => 'Blockid',
            'Dagger' => 'Dagger',
            'Aster' => 'ICD Code',
            'WithoutDot' => 'Without Dot',
            'Title' => 'Title',
            'Mortality1' => 'Mortality1',
            'Mortality2' => 'Mortality2',
            'Mortality3' => 'Mortality3',
            'Mortality4' => 'Mortality4',
            'Mortality5' => 'Mortality5',
        ];
    }
}
