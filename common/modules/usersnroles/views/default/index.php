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


$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reguser-index">

    <h4><?= Html::encode("Employees") ?></h4>

    

    <p>
        <?= Html::a('Add Employee', ['add-employee'],[
            'value' => Url::toRoute(['add-employee']), 'title' => 'Add Employee', 
            'class' => 'btn btn-success showModalButton']) ?>
    </p>

    <?php Pjax::begin(['id' => 'regusers']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            //'pwd:boolean',
            'regUser.name',
            'regUser.fname',
            'regUser.dob',
            'regUser.sex',
            //'tribe',
            //'commu',
            'regUser.bg',
            'regUser.mobno',
            'regUser.add1',
            //'dist',
            [
				'label'=>'Roles',
				'format'=>'raw',
				'value' => function($data){					
					return Html::a('Roles', ['roles/userroles','user_id' => $data->user_id], ); 	 
				}
			],
            [
				'label'=>'Assign Role',
				'format'=>'raw',
				'value' => function($data){					
					return Html::a('Assign Role', ['roles/assign-user-role','user_id' => $data->user_id], ); 	 
				}
			],
            [
				'label'=>'',
				'format'=>'raw',
				'value' => function($data){	
                    $url =Url::to(['employee-details','emp_id' => $data->id]) ;									
                    return Html::a('<span class="fa fa-eye"></span>',
                        $url, ['value' => $url, 'title' => 'Employee Details', 'class' => 'showModalButton']);						 
				}
			],
            
        ],
    ]); ?>
    <?php Pjax::end() ?>

</div>
