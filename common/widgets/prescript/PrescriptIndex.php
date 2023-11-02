<?php

namespace common\widgets\prescript;
//use app\models\Encounter;
use yii\base\Widget;
use yii\helpers\Html;

class PrescriptIndex extends Widget
{
    public $dataProvider;
    public $idopd;

    public function init()
    {           
        parent::init();
        //$this->model = model;
    }

    public function run()
    {
        return $this->render('prescript-index', [
            'dataProvider' => $this->dataProvider, 'idopd' => $this->idopd
        ]);
    }
}