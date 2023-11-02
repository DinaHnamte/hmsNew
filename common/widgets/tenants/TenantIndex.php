<?php

namespace common\widgets\tenants;
//use app\models\Encounter;
use yii\base\Widget;
use yii\helpers\Html;

class TenantIndex extends Widget
{
    public $dataProvider;
    public $actionUrl1;
    public $actionUrl2;

    public function init()
    {           
        parent::init();
        // if($this->actionUrl1===null){
        //     $this->actionUrl1='';
        // }
        // if($this->actionUrl2===null){
        //     $this->actionUrl2='';
        // }
    }

    public function run()
    {
        return $this->render('tenant-index', [
            'dataProvider' => $this->dataProvider,
            'actionUrl1' => $this->actionUrl1,
            'actionUrl2' => $this->actionUrl2,
        ]);
    }
}