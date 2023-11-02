<?php

namespace common\widgets\tenants;
//use app\models\Encounter;
use yii\base\Widget;
use yii\helpers\Html;

class TenantView extends Widget
{
    public $model;

    public function init()
    {           
        parent::init();
        //$this->model = model;
    }

    public function run()
    {
        return $this->render('tenant-view', [
            'model' => $this->model,
        ]);
    }
}