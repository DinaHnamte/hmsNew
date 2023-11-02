<?php

use common\models\utilities\Icd10;
use common\models\utilities\Blocks;
use common\models\utilities\Chapters;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Icd10s';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="icd10-index">

    <h3><?= Html::encode("ICD10 Detail") ?></h3>       
	<p>
        
        <?= Html::a('Delete', ['view-my-icd10', 'myicd_id' => $model->id], [
            'class' => 'btn btn-danger postDataAjax', 
            'pjaxTarget' => 'myicdcodes-table',
            'pdata' => ['myicd_id' => $model->id,
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'icd10.Level',
            'icd10.Category',
            'icd10.Dagger',
            [
                'label'  => 'Icd Code',
                'value'  => function($model){					
                    return $model->icd10->Aster; 
                }
            ],
            'icd10.WithoutDot',
            [
                'label'  => 'Title',
                'value'  => function($model){					
                    return $model->icd10->title; 
                }
            ],
            'icd10.Mortality1',
            'icd10.Mortality2',
            'icd10.Mortality3',
            'icd10.Mortality4',
            'icd10.Mortality5',
            
        ],
    ]) ?>   


</div>

