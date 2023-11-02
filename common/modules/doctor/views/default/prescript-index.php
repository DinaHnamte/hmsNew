<?php

use app\models\Prescript;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Prescripts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id='priscripttable'>
    <?= common\widgets\prescript\PrescriptIndex::widget([
            'dataProvider' => $dataProvider, 'idopd' => $idopd
        ]) ?> 
    </div>


