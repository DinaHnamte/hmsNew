<?php

use app\models\auth\Reguser;
use app\models\Employee;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */


$this->title = 'Doctors';
$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reguser-index">

    <h3><?= Html::encode("Doctors") ?></h3>

    
    <?php Pjax::begin(['id' => 'dr_regusers']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            //'pwd:boolean',
            'regUser.name',
            'regUser.fname',
            //'regUser.dob',
            //'regUser.sex',
            //'tribe',
            //'commu',
            //'regUser.bg',
            'regUser.mobno',
            'regUser.add1',
            //'dist',
            [
				'label'=>'Department',
				'format'=>'raw',
				'value' => function($data){	                    
                    if($data->empDept!==null){                        
                        return Html::a($data->empDept->dept->name, ['remove-dr','id' => $data->empDept->id], 
                                [ 'title' => 'Remove from Department', 'class' => 'showModalLink']);
                    }else{ 
                       return Html::a('Assign-dept', ['assign-dept','emp_id' => $data->id], 
                       ['title' => 'Select Department', 'class' => 'showModalLink']);
                    }	
                      
				}
			],
                                    
        ],
    ]); ?>
    <?php Pjax::end() ?>

</div>
