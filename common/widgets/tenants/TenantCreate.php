<?php

namespace common\widgets\tenants;
//use app\models\Encounter;
use yii\base\Widget;
use yii\helpers\Html;

class TenantCreate extends Widget
{
    public $model;

    public function init()
    {           
        parent::init();
        //$this->model = model;
    }

    public function run()
    {
        return $this->render('tenant-create', [
            'dataProvider' => $dataProvider,
        ]);
    }
}