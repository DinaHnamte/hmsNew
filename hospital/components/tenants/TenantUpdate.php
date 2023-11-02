<?php

namespace hospital\components\widgets\tenants;
//use app\models\Encounter;
use yii\base\Widget;
use yii\helpers\Html;

class TenantUpdate extends Widget
{
    public $model;

    public function init()
    {           
        parent::init();
        //$this->model = model;
    }

    public function run()
    {
        return $this->render('tenant-update', [
            'dataProvider' => $dataProvider,
        ]);
    }
}