<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "medicines".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $form
 * @property string|null $composition
 * @property string|null $manufacturer
 * @property float|null $mrp
 * @property string|null $price
 * @property string|null $packaging
 */
class Medicines extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medicines';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mrp'], 'number'],
            [['name'], 'string', 'max' => 34],
            [['form'], 'string', 'max' => 10],
            [['composition'], 'string', 'max' => 139],
            [['manufacturer'], 'string', 'max' => 38],
            [['price'], 'string', 'max' => 5],
            [['packaging'], 'string', 'max' => 35],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'form' => 'Form',
            'composition' => 'Composition',
            'manufacturer' => 'Manufacturer',
            'mrp' => 'Mrp',
            'price' => 'Price',
            'packaging' => 'Packaging',
        ];
    }
}
